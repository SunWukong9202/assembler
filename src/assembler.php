<?php
namespace Assembler;

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\Recognizer;

class AssemblerErrorListener extends BaseErrorListener {
    public function syntaxError(Recognizer $recognizer, ?object $offendingSymbol, int $line, int $charPositionInLine, string $msg, ?RecognitionException $exception): void
    {
        $map = $recognizer->getTokenTypeMap();
        $rules = $recognizer->getRuleIndexMap();
        $names = $recognizer->getRuleNames();
        echo "@Error en linea $line:$charPositionInLine: $msg\n";   
    }
}

class Assembler {

    public function run($argv): void
    {
        if(!isset($argv[1])) {
            echo "Please run: php assembler <file_name>.xe\n";
            return;
        }

        $path = $argv[1];
        $info = pathinfo($path);
        
        if(!isset($info['extension']) && strtolower($info['extension']) != "xe") {
            echo "Incorrect extension {$info['extension']}, only .xe is supported\n";
            return;
        }

        [$before_step2, $intermediate, $tabsim] = $this->evaluate($path);

        // $printable = array_slice($visitor->getIntermediate(), 0, 20);
        $printables = [ '1', '2','30', '33', '37'];
        print_r($this->printOnly($before_step2));
        $this->imprimirTabla($before_step2);
        $this->imprimirTablaObjcode($intermediate);
        print_r($tabsim);
    }

    public function evaluate($path) : array
    {
        $stream = InputStream::fromPath($path);
        $lexer = new assembler3Lexer($stream);
        $lexer->removeErrorListeners();
        $lexer->addErrorListener(new AssemblerErrorListener);
        $tokens = new CommonTokenStream($lexer);
        $parser = new assembler3Parser($tokens);
        $parser->removeErrorListeners();
        $parser->addErrorListener(new AssemblerErrorListener);

        $tree = $parser->prog();
    
        $visitor = new Visitor();
        try{
            $visitor->visit($tree);
        } catch(\Exception $e) {
            echo "Excepcion: {$e->getMessage()}\n";
        }
        $intemediate = $visitor->getIntermediate();
        $errors = $visitor->getErrors();
        $step2 = new STEP2($visitor->tabSim, $intemediate);
        $step2->assembly();
        $registers = $step2->getRegisters();
        return [
            $intemediate,
            $step2->intermediate,
            $visitor->tabSim,
            $errors,
            $registers
        ];
    }

    public function printOnly($source, $choosen = null): array
    {
        if($choosen == null) return $source;
        $resp = [];
        foreach($source as $target) {
            if(in_array($target['line'], $choosen)) $resp[] = $target;
        }
        return $resp;
    }

    function imprimirTabla($datos, $path = 'tabla.txt')
    {
        $out = "---------------------------------------------------------------------------------------------\n";
        $out.= "|   NUM      |   FORMATO  |     PC     |     ETQ     |     INS    |    OPER    |     MODO   |\n";
        $out.= "---------------------------------------------------------------------------------------------\n";

        // Datos
        foreach ($datos as $fila) {
            $mode = '---';
            if($fila['mode'] instanceof Mode) {
                $mode = $fila['mode']->toString();
            }
            $out.=sprintf("| %-10s | %-10s | %-10s | %-10s  | %-10s | %-10s | %-10s |\n",
            $fila['line'], $fila['format'], $fila['pc'], $fila['label'], $fila['codop'], $fila['temp']['op_col'] ?? '', $mode );

        }

        // Línea de cierre
        $out.= "---------------------------------------------------------------------------------------------\n";
            // Guarda en un archivo
        file_put_contents($path, $out);
    }

    function imprimirTablaObjcode($datos, $path = 'tablaobjCode.txt')
    {
        $out = "------------------------------------------------------------------------------------------------------------\n";
        $out.= "|   NUM      |   FORMATO  |     PC     |     ETQ     |     INS    |    OPER    |     MODO   |    Objcode    |\n";
        $out.= "------------------------------------------------------------------------------------------------------------\n";
        // Datos
        foreach ($datos as $fila) {
            $mode = '---';
            if($fila['mode'] instanceof Mode) {
                $mode = $fila['mode']->toString();
            }
            $out.=sprintf("| %-10s | %-10s | %-10s | %-10s  | %-10s | %-10s | %-10s | %-12s |\n",
            $fila['line'], $fila['format'], $fila['pc'], $fila['label'], $fila['codop'], $fila['temp']['op_col'] ?? '', $mode, $fila['objCode']);

        }

        // Línea de cierre
        $out.= "------------------------------------------------------------------------------------------------------------\n";
            // Guarda en un archivo
        file_put_contents($path, $out);
    }
}
