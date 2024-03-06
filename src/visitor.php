<?php

namespace Assembler;

use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Assembler\Context\BaseContext;
use Assembler\Context\BeginProgContext;
use Assembler\Context\BothMissingContext;
use Assembler\Context\ByteContext;
use Assembler\Context\ByteErrorContext;
use Assembler\Context\CommaMissingContext;
use Assembler\Context\Directive_Context;
use Assembler\Context\DirectiveOptContext;
use Assembler\Context\EndProgContext;
use Assembler\Context\Instruction_Context;
use Assembler\Context\InstructionOptContext;
use Assembler\Context\LinesContext;
use Assembler\Context\Op1MissingContext;
use Assembler\Context\Op2MissingContext;
use Assembler\Context\ResbContext;
use Assembler\Context\ReswContext;
use Assembler\Context\WordContext;

class Visitor extends assembler3BaseVisitor
{   
    public $lines = 0;
    private $printErrors = true;
    private $debug = true;
    protected $instructions = [];
    public $tabSim = [];
    protected $pc = 0;
    protected $errores = [];
    protected $line = "";
    protected $tag = "";
    protected $temp = [];

    public function __construct()
    {
        $this->instructions = require(__DIR__."/../instructionSet.php");
        // var_dump($this->instructions);
        $this->tabSim = [];
        $this->errores = [];
        $this->clearFile('errores.err');
        $this->clearFile('intermedio.txt');
        $this->clearFile('tabSim.txt');
    }

    public function clearFile(string $file): void
    {
        $file = fopen($file, 'w');  // 'w' abre el archivo para escritura (write), sobrescribe el contenido existente

        if ($file) {
            fwrite($file, "");  // Escribe una cadena vacía para limpiar el archivo
            fclose($file);
            echo "Archivo limpiado.\n";
        } else {
            echo "Ocurrió un error al intentar limpiar el archivo\n";
        }
    }

    public function putLineOn($line, $file = 'errores.err'): void
    {
        $file = fopen($file, 'a');

        if($file) {
            fwrite($file, $line);
            fclose($file);
            echo "Guardado\n";
        }
        else {
            echo "Ocurrio un error\n";
        }
    }

    function ajustHexLength($hex, $length) {
        // Agregar ceros a la izquierda hasta alcanzar la longitud deseada
        $adjustedHex = str_pad($hex, $length, '0', STR_PAD_LEFT);
    
        return $adjustedHex;
    }
    

    protected function getFormat($codop): bool|string
    {
        return match(true) {
            !isset($codop) => false,
            isset($this->instructions['formato1'][$codop->getText()]) => 'f1',
            isset($this->instructions['formato2'][$codop->getText()]) => 'f2', 
            isset($this->instructions['formato3'][$codop->getText()]) => 'f3',
            default => false,
        };
    }
    public function visitBeginProg(BeginProgContext $ctx)
    {
        $this->lines++;
        $this->pc = 0;
        $label = $ctx->ID();
        $start = $ctx->START();
        $address = $ctx->NUM();
        $this->temp['address'] = $this->getIntFrom($address?->getText() ?? 0);
        if($address !== null) $this->pc = intval($address->getText());
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
        if(!isset($label) || !isset($start) || !isset($address)) {
            $error = "Error-INICIO: Error de sintaxis en linea {$this->lines}\n";
            if($this->printErrors) echo $error;
            $this->putLineOn($error);
        }
    }

    public function visitInstructionOpt(InstructionOptContext $ctx)
    {
        $this->lines++;
        if($this->debug) echo "ins-opt: {$this->lines} {$ctx->getText()}\n";
        $label = $ctx->ID(0);
        $this->tag = $label;
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
        $this->line = "{$this->lines}\t{$this->pc}";
        // $this->insertInSimTab($label);
        if($this->debug) echo "L-$label\n";
        $this->temp['label'] = $label;
        $this->visitChildren($ctx);
    }

    protected function insertInSimTab(mixed $label): void
    {
        if(!isset($label)) return;
        if(isset($this->tabSim[$label->getText()])) {
            $error = "@Error en la linea {$this->lines}: Simbolo Duplicado\n";
            if($this->printErrors) echo $error;
            $this->putLineOn($error);
        }
        else {
            $pc = $this->ajustHexLength(dechex($this->pc), 6);
            $this->putLineOn("$pc | $label\n", 'tabSim.txt');
            $this->tabSim[$label->getText()] = $pc;
        }
    }

    public function visitDirectiveOpt(DirectiveOptContext $ctx)
    {
        $this->lines++;
        if($this->debug) echo "dir-opt: {$this->lines} {$ctx->getText()}\n";
        $label = $ctx->ID(0);
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
        $this->tag = $label;
        $this->line = "{$this->lines}\t{$this->pc}";
        $this->insertInSimTab($label);
        $this->visitChildren($ctx);
    }

    public function visitEndProg(EndProgContext $ctx)
    {
        // echo "text: {$ctx->getText()}\n";
        $this->lines++;
        $programSize = dechex($this->pc - $this->temp['address']);
        $this->putLineOn("Program Size: $programSize\n", 'tabSim.txt');
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
    }

    public function visitInstruction_(Instruction_Context $ctx)
    {
        $codop = $ctx->ID(0);
        $plus = $ctx->PLUS();
        $mode = $ctx->AT()?->getText() ?? $ctx->HASH()?->getText();
        $op1 = $ctx->ID(1) ?? $ctx->NUM(0);
        $comma = $ctx->COMMA();
        $op2 = $ctx->ID(2) ?? $ctx->NUM(1);
        $label = $this->temp['label'];
        $format = $this->getFormat($label);

        if($format) {
            $op = $codop;
            //CHECAR POR OP1 VALIDO
            if($this->debug) echo "1-OP {$this->lines}: $label $op\n";
            $format = $plus !== null ? 'f4' : $format;
            $this->pc += intval(substr($format, 1));
            if(isset($op1)) {
                //dos operadores sin coma
                if($this->debug) echo "@Error de sintaxis {$this->lines}: Operadores mal formateados\n";
            }
            // if($this->debug) echo "NO-L:$label $addrMode-op1=$op1-c=$comma-op2=$op2\n";
        }
        else if($this->getFormat($op1)) {
            if($this->debug) echo "@Error de sintaxis {$this->lines}: Operadores mal formateados\n";
        }
        else if(!$this->getFormat($codop)) 
        {
            if($this->debug) echo "@Error {$this->lines}: Instruccion no existe\n";
            // if($this->debug) echo "@Error {$this->lines}: $plus$codop $addrMode$op1$comma$op2\n";
        }
        else {
            // Seccion en teoria libre de errores de operadores
            $format = $this->getFormat($codop);
            $m = $ctx->ID(1);
            $c = $ctx->NUM(0);
            $x = $ctx->ID(2);
            $isNotValid = isset($op1) || isset($mode) || isset($op2) || isset($plus);
            $error = false;
            if($format == 'f1' && $isNotValid) {
                $error = "@Error en linea {$this->lines}: formato 1 invalido\n";
                if($this->debug) echo $error;
            }
            $isNotValid = isset($mode) || isset($plus);
            if($format == 'f2' && $isNotValid) {
                $error = "@Error en linea {$this->lines}: formato 2 invalido\n";
                if($this->debug) echo $error;
            }

            $isNotValid = (isset($op2) && $op2->getText() !== 'X') || (isset($mode) && isset($op2))
            || (isset($op1) && $codop->getText() == 'RSUB');
            if($format == 'f3' && $isNotValid) {
                $f = $plus !== null ? 4 : 3;
                $error = "@Error en linea {$this->lines}: formato $f invalido\n";
                if($this->debug) echo $error;
            }
            if($this->debug) echo "{$this->lines}: $plus$codop $mode-$op1-$comma-$op2\n";
            if($error) {
                return;
            }

            $this->insertInSimTab($label);
            $format = $plus !== null ? 'f4' : $format;
            $format = substr($format, 1);
            $this->pc += intval($format);
        }

        $this->visitChildren($ctx);    
    }

    // protected function pickFormat($format, $addressMode): void
    // {
    //     if($format == 'f3') {
    //         $mode = match($addressMode) {
    //             '@' => 'indirecto',
    //             '#' => 'inmediato',
    //             default => 'simple'
    //         };
    //         $this->line .= "\t$mode";
    //     };
    //     $this->putGeneratedLine($this->line);
    // }

    public function visitByte(ByteContext $ctx)
    {
        if($ctx->BYTE() == null) {
            return;
        }

        $const = $ctx->CONS()?->getText();
        $consx = $ctx->CONSX()?->getText();
        // $this->pc +
        $c = match(true) {
             $const !== null 
             => $this->getConstLen($const),
             $consx !== null
             =>($this->getConstLen($consx) % 2 !== 0 
                ? ($this->getConstLen($consx) + 1) //completar byte
                : $this->getConstLen($consx) ) / 2,
             default => 0
        };
        echo "BYTE: $c\n";
        $this->pc += $c;
    }

    protected function getConstLen($const): string
    {
        // Avoid 2 first char (X|C)' and last '
        return strlen(substr($const, 2, strlen($const) - 1 - 2));
    }

    public function visitWord(WordContext $ctx)
    {
        if($ctx->WORD() == null || $ctx->NUM() == null) {
            return;
        }
        
        $this->pc += 3;
    }

    public function visitResb(ResbContext $ctx)
    {
        if($ctx->RESB() == null || $ctx->NUM() == null) {
            return;
        }
        
        $this->pc += $this->getIntFrom($ctx->NUM()->getText());
    }
    
    public function visitResw(ReswContext $ctx)
    {
        if($ctx->RESW() == null || $ctx->NUM() == null) {
            return;
        }
        
        $num = $ctx->NUM()->getText();
        //maneja hex y integers
        $int = $this->getIntFrom($num);
        $this->pc += $int * 3;
    }

    public function visitBase(BaseContext $ctx)
    {
        if($ctx->BASE() == null || $ctx->ID() == null) {
            return;
        }
    }

    protected function getIntFrom(string $num): int
    {        
        $aux = $this->canGetHex($num) 
        ? hexdec($num) 
        : $num;
        echo "$num - to dec -> $aux\n";
        return intval($aux);
    }

    protected function canGetHex(string $num): string|bool
    {
        return strpos($num, 'H') !== false;
    }


    public function visitOp1Missing(Op1MissingContext $context)
    {
        $this->lines++;   
    }

    public function visitBothMissing(BothMissingContext $context)
    {
        $this->lines++;   
    }
    
    public function visitOp2Missing(Op2MissingContext $context)
    {
        $this->lines++;   
    }

    public function visitCommaMissing(CommaMissingContext $context)
    {
        $this->lines++;   
    }

    public function visitByteError(ByteErrorContext $context)
    {
        $this->lines++;
        echo "Error in BYTE {$this->lines}: \n";    
    }
}



        // $codop = $ctx->ID(0);
        // echo "codop: {$ctx->ID(0)->getText()} id1: {$ctx->ID(1)?->getText()} id2\n";
        // // echo "AHDA: {$this->existsIns($codop->getText() ? 'true' : 'false')}\n";
        // $opcode = !in_array($codop->getText(), $this->instructions);
        // $op = $ctx->ID(1) ?? $ctx->NUM(0);
        // $comma = $ctx->COMMA();
        // $op2 = $ctx->ID(2) ?? $ctx->NUM(1);
        // // echo "errOp: $op - $op2 - comma: $comma\n";
        // $errorOp = isset($op) && isset($comma) && !isset($op2); 

        // if($opcode) {
        //     $error =  "Error: Instruccion no existe en la linea {$this->lines}\n";
        //     // echo $error;
        //     $this->errores[] = $error;
        // }
        
        // if($errorOp) {
        //     $error =  "Error: Error de sintaxis en la linea {$this->lines}\n";
        //     // echo $error;
        //     $this->errores[] = $error;
        // }
        // return [];

            // $value = match() {
        //     '+' => $left + $right,
        //     '-' => $left - $right,
        //     default => null
        // };
        // Acceder al token '+' opcional
        // $plus = $ctx->PLUS();
        // // Acceder al token ID

        // // Acceder al token '@' o '#'
        // $format = $ctx->AT() ?? $ctx->HASH();

        // // Acceder al token ID o NUM
        // $param = $ctx->ID(1) ?? $ctx->NUM(0);
        // // Acceder a los tokens ',' y ID o NUM adicionales
        // $comma = $ctx->COMMA();
        // $op = $ctx->ID(2) ?? $ctx->NUM(1);
        // echo "f4: $plus; codop: $codop; @-: $format; param: $param; comma: $comma; op: $op\n";