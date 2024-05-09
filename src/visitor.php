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
use Assembler\Enums\ASMError;
use Assembler\Enums\Line;
use Assembler\Enums\Mode;

class Visitor extends assembler3BaseVisitor
{   
    use HexHelpers;
    use FileHelper;

    public $lines = 0; private $printErrors = false;
    private $debug = false;
    protected $instructions = [];
    public $tabSim = [];
    protected $pc = 0;
    protected $errors = [];
    protected $temp = [];

    protected $intermediate = [];
    private $directives = ['BYTE', 'WORD', 'RESB', 'RESW', 'BASE'];

    public function __construct()
    {
        $this->instructions = require(__DIR__."/../instructionSet.php");
        // var_dump($this->instructions);
        $this->tabSim = [];
        $this->clearFile('errores.err');
        $this->clearFile('intermedio.txt');
        $this->clearFile('tabSim.txt');
    }

    public function getIntermediate()
    {
        return $this->intermediate;
    }

    public function getErrors() {
        $errores = file_get_contents('errores.err');
        return $errores;
    }

    protected function getFormat($codop): bool|string
    {
        return match(true) {
            !isset($codop) || !$codop => false,
            isset($this->instructions['formato1'][$codop]) => '1',
            isset($this->instructions['formato2'][$codop]) => '2', 
            isset($this->instructions['formato3'][$codop]) => '3',
            default => false,
        };
    }

    private function insertInIntermediate(
        $type, $format, $label, $codop, $op1, $op2, $mode,$error, $temp = []
        ): void
    {
        $hex = false;
        if(in_array($format, ['1','2','3','4'])) {
            $f = $format;
            if($format == '4') {
                $f = '3';
            }
            if($codop =='RSUB') {
                $mode = '---';
            }
            $hex = $this->instructions["formato$f"][$codop];
            if($format == '4') {
                $codop = '+'.$codop;
            }
        }
        $this->intermediate[] = [
            'type' => $type,
            'line' => $this->lines,
            'format' => !$format ? '---': $format, 
            'pc' => $this->adjustHexLength(dechex($this->pc), 4),
            'label' => $label,
            'codop' => $codop,
            'mode' => !$mode ?'---' : $mode,
            'op'=> $op1 ?? false, 'op2'=> $op2 ?? false, 
            'error' => $error,
            'temp' => $temp,
            'hex' => $hex
        ];
    }

    public function visitBeginProg(BeginProgContext $ctx)
    {
        $this->lines++;
        $this->pc = 0;
        $label = $ctx->ID()?->getText();
        $start = $ctx->START()?->getText();
        $address = $ctx->NUM()?->getText();
    
        $this->temp['address'] = $this->getIntFrom($address ?? 0);
        if($address !== null) $this->pc = intval($address);
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
        $err = false;
        if(!isset($label) || !isset($start) || !isset($address)) {
            $err = ASMError::sintax;
            $error = "Error-INICIO: Error de sintaxis en linea {$this->lines}\n";
            if($this->printErrors) echo $error;
            $this->putLineOn($error);
        }
        $addr = $this->adjustHexLength(dechex($this->temp['address']), 6); 
        $this->insertInIntermediate(Line::HEADER,
        false, $label, $start, $addr, false, false, $err, ['op_col' => $address]);
    }

    public function visitInstructionOpt(InstructionOptContext $ctx)
    {
        $this->lines++;
        if($this->debug) echo "ins-opt: {$this->lines} {$ctx->getText()}\n";
        $label = $ctx->ID(0)?->getText();
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
        // $this->insertInSimTab($label);
        if($this->debug) echo "L-$label\n";
        $this->temp['label'] = $label;
        $this->visitChildren($ctx);
    }

    protected function insertInSimTab(mixed $label): void
    {
        if(!isset($label)) return;
        if(isset($this->tabSim[$label])) {
            $error = "@Error en la linea {$this->lines}: Simbolo Duplicado\n";
            if($this->printErrors) echo $error;
            $this->putLineOn($error);
        }
        else {
            $pc = $this->adjustHexLength(dechex($this->pc), 4);
            $this->putLineOn("$pc | $label\n", 'tabSim.txt');
            $this->tabSim[$label] = $this->adjustHexLength(dechex($this->pc), 4);
        }
    }

    public function visitDirectiveOpt(DirectiveOptContext $ctx)
    {
        $this->lines++;
        if($this->debug) echo "dir-opt: {$this->lines} {$ctx->getText()}\n";
        $label = $ctx->ID(0)?->getText();
        $this->temp['label'] = $label;
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
        $this->visitChildren($ctx);
    }

    public function visitEndProg(EndProgContext $ctx)
    {
        // echo "text: {$ctx->getText()}\n";
        $this->lines++;
        $label = $ctx->ID()?->getText() ?? $ctx->NUM()?->getText();
        $programSize = dechex($this->pc - $this->temp['address']);
        $programSize = $this->adjustHexLength($programSize, 6);
        $this->tabSim['PROGRAM_SIZE'] = $programSize;

        $this->insertInIntermediate(
            Line::END, false, false, 'END', $label, false, false, false, ['op_col' => $label]);

        $this->putLineOn("Program Size: $programSize\n", 'tabSim.txt');
        $pc = dechex($this->pc);
        $this->putLineOn("$pc: {$ctx->getText()}\n", 'intermedio.txt');
    }

    public function visitInstruction_(Instruction_Context $ctx)
    {
        $codop = $ctx->ID(0)?->getText();
        $plus = $ctx->PLUS()?->getText();
        $mode = $ctx->AT()?->getText() ?? $ctx->HASH()?->getText();
        // $op1 = $ctx->ID(1)?->getText() ?? $ctx->NUM(0)?->getText();
        $op1 = $ctx->op1?->getText();
        $comma = $ctx->COMMA()?->getText();
        // $op2 = $ctx->ID(2)?->getText() ?? $ctx->NUM(1)?->getText();
        $op2 = $ctx->op2?->getText();
        $label = $this->temp['label'];
        $format = $this->getFormat($label);
        $error = false;
        if($format) {
            $op = $codop;
            $format = $plus !== null ? '4' : $format;
            $mode = $format == '3' || $format == '4' ? 
                    Mode::getMode($mode): null;

            $temp['op_col'] = "$op";
            $temp['isOp2Num'] = $temp['isOp1Num'] = false;
        
            if(isset($op1)) {
                //dos operadores sin coma
                $temp['op_col'] = "$op $op1";
                $error = ASMError::sintax;
                if($this->debug) echo "@Error de sintaxis {$this->lines}: Operadores mal formateados\n";
                $this->insertInIntermediate(Line::INSTRUCTION, 
                $format, false, $label, $op, $op1, $mode, $error, $temp);
                return;
            }

            $this->insertInIntermediate(Line::INSTRUCTION, 
            $format, false, $label, $op, null, $mode, false, $temp);
            //CHECAR POR OP1 VALIDO SIN ADDR MODE
            //dado puede ser c o m cualquier op es valido excepto
            if($this->debug) echo "1-OP {$this->lines}: $label $op\n";
            $this->pc += intval($format);
        }
        //checa por labels con nombre de opcode
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

            $isNum1 = false;
            $isNum2 = false;
            
            if(isset($op1) && $this->isHexOrDec($op1)) $isNum1 = true;
            if(isset($op2) && $this->isHexOrDec($op2)) $isNum2 = true;

            $isNotValid = isset($op1) || isset($mode) || isset($op2) || isset($plus);
            $error = false;
            if($format == '1' && $isNotValid) {
                $error = "@Error en linea {$this->lines}: formato 1 invalido\n";
                if($this->debug) echo $error;
            }
            $isNotValid = isset($mode) || isset($plus);
            if($format == '2' && $isNotValid) {
                $error = "@Error en linea {$this->lines}: formato 2 invalido\n";
                if($this->debug) echo $error;
            }
            $format = $plus !== null ? '4' : $format;

            //modo en este punto solo toma en cuenta indirecto y inmediato.
            //en el modo simple es valido tener un segundo operando
            $isNotValid = (isset($op2) && $op2 !== 'X') || (isset($mode) && isset($op2))
            || (isset($op1) && $codop == 'RSUB');
            if($format == '3' && $isNotValid) {
                $error = "@Error en linea {$this->lines}: formato $format invalido\n";
                if($this->debug) echo $error;
            }
            if($this->debug) echo "{$this->lines}: $plus$codop $mode-$op1-$comma-$op2\n";
            $temp['op_col'] = "$mode$op1$comma $op2";
            $temp['isOp1Num'] = $isNum1;
            $temp['isOp2Num'] = $isNum2;
            $mode = $format == '3' || $format == '4' ? 
            Mode::getMode($mode): '---';
            if($error) {
                $this->insertInIntermediate(Line::INSTRUCTION,
                $format, $label, $codop, $op1, $op2, $mode, $error, $temp);
                return;
            }
            $this->insertInSimTab($label);
            $this->insertInIntermediate(Line::INSTRUCTION,
                $format, $label, $codop, $op1, $op2, $mode, $error, $temp);
            $this->pc += intval($format);
        }

        $this->visitChildren($ctx);    
    }

    public function visitByte(ByteContext $ctx)
    {
        $label = $this->temp['label'];
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
        $temp['bytes'] = $c;
        $temp['op_col'] = $const ?? $consx;
        $contentx = substr($consx, 2, strlen($consx) - 1 - 2);
        $content = substr($const, 2, strlen($const) - 1 - 2);
    
        if(!$this->isLabelValid($label)) {
            $this->putLineOn("@Error de sintaxis en linea {$this->lines}\n"); 
            $this->insertInIntermediate(Line::DIRECTIVE,
            false, $label, $ctx->BYTE()?->getText(), $const, $consx,false,ASMError::sintax, $temp);
            return;
        }

        $this->insertInIntermediate(Line::DIRECTIVE,
        false, $label, 'BYTE',$content, $contentx,
        false,false, $temp);
        // echo "BYTE: $c\n";
        $this->pc += $c;
        return true;
    }

    protected function getConstLen($const): string
    {
        // Avoid 2 first char (X|C)' and last '
        return strlen(substr($const, 2, strlen($const) - 1 - 2));
    }

    private function isLabelValid($label): bool
    {
        //de momento checa por labels con nombre de directivas
        if($label != null && isset($this->directives[$label])) {
            return false;
        }
        $this->insertInSimTab($label);
        return true;
    }

    public function visitWord(WordContext $ctx)
    {
        $label = $this->temp['label'];
        if(!$this->isLabelValid($label)) {
            $this->putLineOn("@Error de sintaxis en linea {$this->lines}\n"); 
            $this->insertInIntermediate(Line::DIRECTIVE,
            false, $label, 'WORD', $ctx->NUM()?->getText(),
            false,false,ASMError::sintax, ['op_col' => $ctx->NUM()?->getText()]);
            return false;
        }
        $this->insertInIntermediate(Line::DIRECTIVE,
        false, $label, 'WORD', $ctx->NUM()?->getText(),
        false,false,false, ['op_col' => $ctx->NUM()?->getText(), 'bytes' => 3]);
        $this->pc += 3;
        return true;
    }

    public function visitResb(ResbContext $ctx)
    {
        $label = $this->temp['label'];
        $resb = $ctx->RESB()?->getText(); 
        $num = $ctx->NUM()?->getText();
        if(!$this->isLabelValid($label)) {
            $this->putLineOn("@Error de sintaxis en linea {$this->lines}\n"); 
            $this->insertInIntermediate(Line::DIRECTIVE,
            false, $label, $resb, $num, false,
            false,ASMError::sintax, ['op_col' => $num]);
            return false;
        }
        $this->insertInIntermediate(Line::DIRECTIVE,
        false, $label, $resb, $num, false,
        false,false, ['op_col' => $num]);
        $this->pc += $this->getIntFrom($ctx->NUM()->getText());
        return true;
    }
    
    public function visitResw(ReswContext $ctx)
    {
        $label = $this->temp['label'];
        $resw = $ctx->RESW()?->getText();
        $num = $ctx->NUM()?->getText();
        if(!$this->isLabelValid($label)) {
            $this->insertInIntermediate(Line::DIRECTIVE,
            false, $label, $resw, $num, false, false, ASMError::sintax, ['op_col' => $num]);
            $this->putLineOn("@Error de sintaxis en linea {$this->lines}\n"); 
            return false;
        }
        
        $this->insertInIntermediate(Line::DIRECTIVE,
        false, $label, $resw, $num, false,
        false,false, ['op_col' => $num]);
        //maneja hex y integers
        $int = $this->getIntFrom($num);
        $this->pc += $int * 3;
        return true;
    }

    public function visitBase(BaseContext $ctx)
    {
        $label = $this->temp['label'];
        $base = $ctx->BASE()?->getText(); 
        $id = $ctx->ID()?->getText();
        if(!$this->isLabelValid($label)) {
            $this->putLineOn("@Error de sintaxis en linea {$this->lines}\n");
            $this->insertInIntermediate(Line::DIRECTIVE,
            false, $label, $base, $id,false, false, ASMError::sintax, ['op_col' => $id]); 
            return false;
        }
        $this->insertInIntermediate(Line::DIRECTIVE,
        false, $label, $base, $id,false, false,false, ['op_col' => $id]);
        return true;
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

    public function visitByteError(ByteErrorContext $ctx)
    {
        $this->putLineOn("@Error de sintaxis en linea {$this->lines}\n"); 
        if($this->debug) echo "in Byte error\n";
        $label = $this->temp['label'];
        $const = $ctx->ERRCONS()?->getText();
        $consx = $ctx->ERRCONSX()?->getText();
        $temp['op_col'] = $const ?? $consx;
        $this->insertInIntermediate(Line::DIRECTIVE,
        false, $label, $ctx->BYTE()?->getText(), $const, $consx,false,ASMError::sintax, $temp);
        $this->lines++;
    }
}
