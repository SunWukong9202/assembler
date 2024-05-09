<?php

namespace Assembler;

use Assembler\Enums\ASMError;
use Assembler\Enums\Line;
use Assembler\Enums\Mode;

class STEP2
{
    use HexHelpers;
    use FileHelper;

    protected $registers = [
        'A' =>  '0',
        'X' =>  '1',
        'L' =>  '2',
        'B' =>  '3',
        'S' =>  '4',
        'T' =>  '5',
        'F' =>  '6',
        'PC' => '8',
        'SW' => '9',
    ];
    public $textRegisters = [];
    private $memAllocators = ['RESB', 'RESW'];
    public $defaultSettled = false;
    private static $MAX_R_LEN = 30; //30 bytes
    public function __construct(
        private $tabSim,
        public $intermediate
    ) {}
    //medios bytes para hex - col o caracteres para texto
    //H-(6-PROG NAME)-(6-INICIO)-(6-PROG LEN)
    //T-(6-PC)-(2 - REG LEN)-(60 - OBJCODE)
    private $register = null;
    private $programName; 
    private $modifiables = [];
    private $comeFromNotValid = false;
    private $allowSaveReg = false;
    private function handleRegistersGeneration($line, $objCode): void
    {
        $ws = ' ';
        $pc = $this->adjustHexLength($line['pc'], 6);
        $isHeader = $line['type'] == Line::HEADER;
        $isInstruction = $line['type'] == Line::INSTRUCTION;
        $isValidDirective = in_array($line['codop'], ['BYTE', 'WORD']);
        $needNewRegister = in_array($line['codop'], $this->memAllocators);
        $createNewAfterSave = false;
        $isNotRelocatable = $isInstruction && $line['format'] == '4' 
        && !$line['temp']['isOp1Num'];
        $isEND = $line['type'] == Line::END;

        if($isHeader) {
            $addr = $line['op'];
            $programSize = $this->searchSymbol('PROGRAM_SIZE');
            $this->programName = $line['label'] ? $line['label'] : 'objCod';
            $programName = $this->fillStrWith($this->programName, $ws);
            $this->textRegisters[] = ['H', $programName, $addr, $programSize];
        }
        // echo "{$line['line']}: pc=$pc pc_line={$line['pc']} objcode: {$objCode}\n";

        if($isInstruction || $isValidDirective) {
            //Crea el primer registro o viene de la ultima dir/instruccion no valida
            if($this->register == null) {
                $this->register = ['type' => 'T', 'pc' => $pc ,'len' => 0, 'obj_code' => ''];
            }
            else if($this->comeFromNotValid) {
                $this->register['len'] = $this->adjustHexLength(dechex($this->register['len']), 2);
                $this->textRegisters[] = $this->register;
                $this->register = ['type' => 'T', 'pc' => $pc ,'len' => 0, 'obj_code' => ''];
                $this->comeFromNotValid = false;
            }

            $accum = $this->register['len'];
            // echo "accum-assign: $accum\n";
            $inc = 0;
            if($isValidDirective) {
                $inc = intval($line['temp']['bytes'] ?? 0);
            } elseif(isset($line['format'])) {
                $inc = intval($line['format']);
            }
            $accum = $accum + $inc;
            // echo "accum-after_inc: $accum\n";
            $f = isset($line['format']) ? $line['format'] : 'NO_SET';
            $bytes = isset($line['temp']['bytes']) ? $line['temp']['bytes'] : 'NO_SET';
            // echo "accum: $accum f=$f bytes=$bytes inc=$inc\n";
            
            if($accum <= static::$MAX_R_LEN) {
                $this->register['obj_code'] .= $objCode;
                $this->register['len'] = $accum;
            }
            //caso de registro lleno
            else {
                $this->register['len'] = $this->adjustHexLength(dechex($this->register['len']), 2);
                $this->textRegisters[] = $this->register;
                $this->register = ['type' => 'T', 'pc' => $pc ,'len' => $inc, 'obj_code' => $objCode];
            }
        }
        //Caso de directiva invalida
        if($needNewRegister){
            $this->comeFromNotValid = true;
        }

        //M-(6 - ADDR)-(2 - nibbles of the field addr)
        if($isNotRelocatable) {
            $oneByteAhead = dechex(hexdec($pc) + hexdec('0001'));
            $oneByteAhead = $this->adjustHexLength($oneByteAhead, 6);
            $programName = $this->fillStrWith($this->programName, $ws);
            $this->modifiables[] = ['M', $oneByteAhead.'05'.'+'.$programName];
        }
        //E-(6 - ADDR LABEL|FIRST INSt TO EXEC)
        if($isEND) 
        {
            $this->register['len'] = $this->adjustHexLength(dechex($this->register['len']), 2);
            $this->textRegisters[] = $this->register;
            $firstExecLine = isset($line['op']) ? $this->searchSymbol($line['op']) : $this->fillStrWith('', 0);
            $firstExecLine = $this->adjustHexLength($firstExecLine, 6);
            $this->textRegisters =  array_merge($this->textRegisters, $this->modifiables);
            $this->textRegisters[] = ['E', $firstExecLine];
            $this->generateObjCode($this->programName);
        }
    }

    public function getRegisters()
    {
        return $this->textRegisters;
    }

    private function generateObjCode($programName)
    {
        $this->clearFile($programName.'.txt');

        foreach($this->textRegisters as $reg) {
            $line = join('', $reg);
            $this->putLineOn($line."\n", $programName.'.txt');
        }
    }

    private function fillStrWith($str, $with, $length = 6) 
    {
        $ws_str = str_repeat($with, $length);
        $str = $str . $ws_str;
        return substr($str, 0, $length);
    }

    public function assembly()
    {
        // foreach($this->intermediate as $line) {
        $b = '0000'; //provisional
        $lines = count($this->intermediate);
        for($i = 0; $i < $lines; $i++) {
            $line = $this->intermediate[$i];

            $isDirective = $line['type'] == Line::DIRECTIVE;
                        
            $objCode = '---';
            $j = $i;
            $next = $this->intermediate[min($j + 1, $lines - 1)];
            $isBASE = $next['codop'] == 'BASE';

            while($isBASE) {
                $j++;
                $b = $this->searchSymbol($next['op']);
                $next = $this->intermediate[$j + 1];
                $isBASE = $next['codop'] == 'BASE';
            }

            if($line['type'] == Line::INSTRUCTION) 
            {
                // if(!$b) $b = '0000';
                if(!$b) $b = '0000';
                $pc = $next['pc'];
                $f = $line['format'];
                $x = '0000'; //provisional
                // echo "in asm {$line['line']}: BASE=$b PC=$pc\n";
                if($line['codop'] == 'RSUB') {
                    $objCode = '4F'; //<- codop y f simple
                    $objCode .= $f == '3' ? '0000' : '000000';
                }
                else {
                    $objCode = match($f) {
                        '1' => $line['hex'],
                        '2' => $this->handleF2($line),
                        '3' => $this->handleF3($line, $pc, $b, $x),
                        '4' => $this->handleF4($line, $b, $x),
                    };
                }
                
                // $this->intermediate[$i]['objCode'] = $objCode;
                // continue;
            }

            $isBYTE = $line['codop'] == 'BYTE';
            $isWORD = $line['codop'] == 'WORD';

            if($isDirective && $isBYTE)
            {
                //CONSX
                if(!$line['op'] && $line['op2']) {
                    $objCode = $this
                    ->adjustHexLength($line['op2'], intval($line['temp']['bytes'])*2);
                }
                //CONST
                if($line['op'] && !$line['op2']) {
                    $objCode = $this->getHexFromString($line['op']);
                }
            }

            if($isDirective && $isWORD) {
                $objCode = $this->adjustHexLength(
                    dechex($this->getIntFrom($line['op'])), 6);
            }
            
            $this->intermediate[$i]['objCode'] = $objCode;
            $this->handleRegistersGeneration($line, $objCode);
        }
    }

    private function handleF2($line): string
    {
        $resp = $line['hex']; $op1 = $line['op']; 
        $op2 = $line['op2']; $codop = $line['codop'];
        $resp .= $op1 ? $this->getRegIfExists($op1,  $line) : '0';
        if(isset($op2) && substr($op2, 0, strlen($op2) - 1) == 'SHIFT')
            $resp .= ''.($op2 - 1);
        else $resp .= $op2 ? $this->getRegIfExists($op2,  $line) : '0';

        return $resp;
    }

    private function getRegIfExists($op, $line): string
    {
        $resp = '0'; $type = false;
        if(isset($this->registers[$op]))
        {
            $resp = $this->registers[$op];
        }
        else if(is_int($op) && in_array($op, $this->registers)) {
            $resp = $op;
        }
        else 
        {
            if(!$line['error']) $line['error'] = ASMError::symbolNotFound;
        }
        return $resp;
    }

    private function calcDisp($addr, $pc, $b, $x, $op2, $offset = 3): array
    {
        $in_range = fn($min, $value, $max) => $min <= $value && $value <= $max;
        $diff = fn($l, $r) => hexdec($l) - hexdec($r);
        $diff_outer = fn($l, $r) => $l - hexdec($r);
        $modifiers = [];
        $x = $op2 == 'X' ? $x : '0000';
        if($op2 == 'X') $modifiers[] = Mode::indice;
        // Relativo al PC
        $desp = $diff_outer($diff($addr, $pc), $x);
        // echo $offset == 5 ? "b-f4: $b\n" : "b-f3: b=$b pc=$pc desp=$desp ta=$addr\n";
        if(!$in_range(-2047, $desp, 2047)) {
            // Relativo a la base
            $desp = $diff_outer($diff($addr, $b), $x);
            $modifiers[] = Mode::relativoB;
            if(!$in_range(0, $desp, 4095)) {
                $modifiers[] = Mode::relativoPC;
                $desp = substr('FFFFFFFF', 0, $offset);
                // echo $offset == 5 ? "f4: $desp\n" : "f3: $desp\n";
                return [
                    ASMError::notOpOrBaseRelative,
                    $desp,
                    $modifiers,
                ];
            }

        }else $modifiers[] = Mode::relativoPC;

        $desp = dechex($desp);
        $desp = $this->subHexStr($desp, $offset);
        // $desp = $this->subHexStr($desp, $offset);
        // echo $offset == 5 ? "v-f4: $desp\n" : "v-f3: $desp\n";
        return [
            false,
            $desp,
            $modifiers,
        ];
    }

    private function searchSymbol(string $symbol): string|false
    {
        return isset($this->tabSim[$symbol])
            ? $this->tabSim[$symbol]
            : false;   
    }


    private function handleF3($line, $pc, $b, $x): string|ASMError
    {
        $codop = $line['hex'].'0';
        if(!($line['mode'] instanceof Mode)) {
            $line['error'] = ASMError::notExistingAddrMode;
            return $codop.'FFF';
        }
        $desp = '';
        $mode = $line['mode'];
        $op1 = $line['op'];
        $c = false;
        $op2 = $line['op2'];
        //Modo directo 
        if($line['temp']['isOp1Num']) {
            $modifiers = [];
            $modifiers[] = $codop;
            $c = $op1;
            $c_dec = $this->getIntFrom($c);
            if($c_dec <= 4095 ) {
                
                $x = $op2 == 'X' ? $x : '0000';
                if($op2 == 'X') $modifiers[] = Mode::indice;
                $Modeflags = $this->adjustHexLength($mode->getFlags($modifiers), 3);
                $desp = hexdec($c_dec - hexdec($x));
                if($c_dec < 0) {
                    $desp = 'FFF';
                    $line['error'] = ASMError::opOutOfRange;
                }

                $desp = hexdec($desp);

                if(in_array($line['line'], ['30', '33', '37'])) {
                    // echo "c: codop=$codop desp=$desp, pc=$pc, b=$b\n";
                    // echo "flags: $Modeflags\n";
                    // print_r($modifiers);
                }

                return $Modeflags.$this->subHexStr($desp);
            }
            $c = dechex($c_dec);
            // Si llega aqui se trata como m y si intenta
            // ensamblar relativo al pc o base
        }
        
        $ta = !$c ? $this->searchSymbol($op1) : $c; 
        $symbolNotFound = false;
        if(!$ta) {
            $line['error'] = ASMError::symbolNotFound;
            //hacemos al calculo fallar, para solo recolectar modificadores
            $pc = $b = 'ffff'; $ta = '0000';
            $symbolNotFound = true;
        } 
        
        [$error, $desp, $modifiers] = $this->calcDisp($ta, $pc, $b, $x, $op2);
        $modifiers[] = $codop;
        $Modeflags = $mode->getFlags($modifiers);

        if($error) {
            if(!$symbolNotFound)$line['error'] = $desp;
        } 
        if(in_array($line['line'], ['30', '33', '37'])) {
            // "label: codop=$codop desp=$desp, pc=$pc, b=$b\n";
            // echo "flags: $Modeflags\n";
            // print_r($modifiers);
        }
        $Modeflags = $this->adjustHexLength($Modeflags, 3);
        return $Modeflags.$desp;
    }

    private function handleF4($line, $b, $x): ASMError|string
    {
        $codop = $line['hex'].'0';
        $error = $codop . 'FFFFF';
        if(!($line['mode'] instanceof Mode) || !$line['op']) {
            $line['error'] = ASMError::notExistingAddrMode;
            return $error;
        }
        $mode = $line['mode']; $op1 = $line['op']; $op2 = $line['op2'];
        $c = false;
        if($line['temp']['isOp1Num']) {
            $c_dec = $this->getIntFrom($op1);
            if($c_dec <= 4095) {
                $line['error'] = ASMError::notExistingAddrMode;
                $ta = '0000'; $pc = $b ='ffff'; $offset = 5;
                [$error, $desp, $modifiers] = $this->calcDisp($c, $pc, $b, $x, $op2, $offset);
                $modifiers[] = Mode::directo; $modifiers[] = $codop;
                $Modeflags = $mode->getFlags($modifiers);
                $Modeflags = $this->adjustHexLength($Modeflags, 3);
                return $Modeflags.$desp;
            } 
            $c = dechex($c_dec);
        }
        $ta = !$c ? $this->searchSymbol($op1) : $c;
        $offset = 5; $desp = ''; $modifiers[] = $codop;
        $modifiers[] = Mode::directo;
        if(!$ta) {
            $line['error'] = ASMError::symbolNotFound; $ta = '0000'; $pc = $b ='ffff'; 
            [$error, $desp, $mod] = $this->calcDisp($ta, $pc, $b, $x, $op2, $offset);
            $modifiers = array_merge($modifiers, $mod); 
            // print_r($modifiers);
        }
        else {
            $desp = $this->adjustHexLength($ta, $offset);
        }
        $Modeflags = $mode->getFlags($modifiers);
        $Modeflags = $this->adjustHexLength($Modeflags, 3);
        return $Modeflags.$desp;
    }

    //Obtinee el numero de nibbles a los cuales ajustar el formato
    private function toFormat($f): int
    {
        return match($f) {
            '1' => 2,
            '2' => 4,
            '3' => 6,
            '4' => 8,
        };
    }

}