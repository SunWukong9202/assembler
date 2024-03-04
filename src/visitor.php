<?php

namespace Assembler;

use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Assembler\Context\BaseContext;
use Assembler\Context\BeginProgContext;
use Assembler\Context\ByteContext;
use Assembler\Context\Directive_Context;
use Assembler\Context\DirectiveOptContext;
use Assembler\Context\EndProgContext;
use Assembler\Context\Instruction_Context;
use Assembler\Context\InstructionOptContext;
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

    public function __construct()
    {
        $this->instructions = require(__DIR__."/../instructionSet.php");
        // var_dump($this->instructions);
        $this->tabSim = [];
        $this->errores = [];
        $this->clearErrorFile();
    }

    public function generateTabSim(): void
    {
        $file = fopen("tabSim.txt", 'w');
        if ($file) {
            foreach ($this->tabSim as $label => $pc) {
                fwrite($file,  $pc.' | '. $label . "\n");
            }
            fclose($file);
            echo "Archivo tabSim.txt generado correctamente.\n";
        } else {
            echo "Ocurrió un error al intentar abrir el archivo tabSim.txt para escritura.\n";
        }
    }
    

    public function clearErrorFile(): void
    {
        $file = fopen('errores.err', 'w');  // 'w' abre el archivo para escritura (write), sobrescribe el contenido existente

        if ($file) {
            fwrite($file, "");  // Escribe una cadena vacía para limpiar el archivo
            fclose($file);
            echo "Archivo de errores limpiado.\n";
        } else {
            echo "Ocurrió un error al intentar limpiar el archivo de errores.\n";
        }
    }

    public function putErrorLine($line): void
    {
        $file = fopen('errores.err', 'a');

        if($file) {
            fwrite($file, $line);
            fclose($file);
            echo "Guardado\n";
        }
        else {
            echo "Ocurrio un error\n";
        }
    }

    public function putGeneratedLine($line): void
    {
        $file = fopen('intermedio.txt', 'a');

        if($file) {
            fwrite($file, $line);
            fclose($file);
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
    

    protected function getFormat(string $codop): bool|string
    {
        return match(true) {
            isset($this->instructions['formato1'][$codop]) => 'f1',
            isset($this->instructions['formato2'][$codop]) => 'f2', 
            isset($this->instructions['formato3'][$codop]) => 'f3',
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
        if($address !== null) $this->pc = intval($address->getText());

        if(!isset($label) || !isset($start) || !isset($address)) {
            $error = "Error-INICIO: Error de sintaxis en linea {$this->lines}\n";
            if($this->printErrors) echo $error;
            $this->putErrorLine($error);
        }
    }

    public function visitInstructionOpt(InstructionOptContext $ctx)
    {
        $this->lines++;
        if($this->debug) echo "ins-opt: {$this->lines} {$ctx->getText()}\n";
        $label = $ctx->ID(0);
        $this->tag = $label;
        $this->line = "{$this->lines}\t{$this->pc}";
        $this->insertInSimTab($label);
        if($this->debug) echo "$label:";
        
        $this->visitChildren($ctx);
    }

    protected function insertInSimTab(mixed $label): void
    {
        if(!isset($label)) return;
        if(isset($this->tabSim[$label->getText()])) {
            $error = "@Error en la linea {$this->lines}: Simbolo Duplicado\n";
            if($this->printErrors) echo $error;
            $this->putErrorLine($error);
        }
        else {
            $pc = $this->ajustHexLength(dechex($this->pc), 6);
            $this->tabSim[$label->getText()] = $pc;
        }
    }

    public function visitDirectiveOpt(DirectiveOptContext $ctx)
    {
        $this->lines++;
        if($this->debug) echo "dir-opt: {$this->lines} {$ctx->getText()}\n";
        $label = $ctx->ID(0);
        $this->tag = $label;
        $this->line = "{$this->lines}\t{$this->pc}";
        $this->insertInSimTab($label);
        $this->visitChildren($ctx);
    }

    public function visitEndProg(EndProgContext $ctx)
    {
        // echo "text: {$ctx->getText()}\n";
        $this->lines++;
    }

    public function visitInstruction_(Instruction_Context $ctx)
    {
        try{
            $plus = $ctx->PLUS();
            $codop = $ctx->ID(0);
            $addressMode = $ctx->AT()?->getText() ?? $ctx->HASH()?->getText();
            $op1 = $ctx->ID(1) ?? $ctx->NUM(0);
            $comma = $ctx->COMMA();
            $op2 = $ctx->ID(2) ?? $ctx->NUM(1);
            if($this->debug) echo "$plus$codop - $addressMode op1 $op1 -$comma - op2=$op2\n";
            $format = $this->getFormat($codop->getText());
            if(!$format) {
                $err = "@Error en la linea $this->lines: Codigo de operacion no encontrado\n";
                if($this->printErrors) echo $err;
                $this->line .= "\t---\t$this->tag\t$plus$codop\t$addressMode$op1$comma$op2";
                $this->line .= "\t$err";
                $this->putGeneratedLine($this->line);
                $this->putErrorLine($err);
                return;
            }

            if($plus !== null) {
                $this->pc += 4;
                return;
            }bin2hex()
            
            $this->pc += match($format) {
                'f2' => 2,
                'f3' => 3,
                'f4' => 4,
                default => 0
            };
            $this->line .= "\t$f\t---\t$this->tag\t$plus$codop\t$addressMode$op1$comma$op2";


        }catch(RecognitionException $e) {
            $line = $e->getOffendingToken()->getLine();
            $charPos = $e->getOffendingToken()->getCharPositionInLine();
            $error = $e->getMessage();
            echo "Error en linea $line: $charPos - $error\n";
        }
        
        $this->visitChildren($ctx);
    
    }

    protected function pickFormat($format, $addressMode): void
    {
        $f = substr($format,1);
        if($format == 'f3') {
            $mode = match($addressMode) {
                '@' => 'indirecto',
                '#' => 'inmediato',
                default => 'simple'
            };
            $this->line .= "\t$mode";
        };
        $this->putGeneratedLine($this->line);
    }

    public function visitByte(ByteContext $ctx)
    {
        if($ctx->BYTE() == null) {
            return;
        }

        $const = $ctx->CONS()?->getText();
        $consx = $ctx->CONSX()?->getText();
        $this->pc += match(true) {
             $const !== null 
             => strlen($const),
             $consx !== null
             => strlen($consx) % 2 !== 0 
             ? (strlen($consx) + 1) * 4
             : strlen($consx) * 4,
             default => 0
        };


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
        ? hexdec(str_replace($num, '', 'H')) 
        : $num;
        echo "$num - to dec -> $aux\n";
        return intval($aux);
    }

    protected function canGetHex(string $num): string|bool
    {
        return strpos($num, 'H') !== false;
    }
    // public function visitDirective_(Directive_Context $ctx)
    // {
    //     echo "dir-type: $ctx->"
    //     // $this->pc += match(true) {
    //     //     isset($ctx->type->BYTE()) => 3,
    //     //     default => 0
    //     // };
    // }
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