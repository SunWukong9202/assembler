<?php

require __DIR__."/vendor/autoload.php";

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\Parser;
use Antlr\Antlr4\Runtime\ParserRuleContext;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Tree\ErrorNode;
use Antlr\Antlr4\Runtime\Tree\ParseTree;
use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
use Antlr\Antlr4\Runtime\Tree\ParseTreeWalker;
use Antlr\Antlr4\Runtime\Tree\TerminalNode;

use Assembler\assembler3Lexer as assemblerLexer;
use Assembler\assembler3Parser as assemblerParser;
use Assembler\Visitor;
use Assembler\Mode;
use Assembler\STEP2;

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

    public function runWithTrustedPath($path): void
    {
        $this->evaluate($path);
    }
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

        echo 'lines: ' . $this->evaluate($path);
    }

    protected function evaluate($path)
    {
        $stream = InputStream::fromPath($path);
        $lexer = new assemblerLexer($stream);
        $lexer->removeErrorListeners();
        $lexer->addErrorListener(new AssemblerErrorListener);
        $tokens = new CommonTokenStream($lexer);
        $parser = new assemblerParser($tokens);
        $parser->removeErrorListeners();
        $parser->addErrorListener(new AssemblerErrorListener);

        $tree = $parser->prog();
    
        $visitor = new Visitor();
        try{
            $visitor->visit($tree);
        } catch(Exception $e) {
            echo "Excepcion: {$e->getMessage()}\n";
        }
        // $printable = array_slice($visitor->getIntermediate(), 0, 20);
        $printables = [ '1', '2','30', '33', '37'];
        print_r($this->printOnly($visitor->getIntermediate()));
        $this->imprimirTabla($visitor->getIntermediate());
        $step2 = new STEP2($visitor->tabSim, $visitor->getIntermediate());
        $step2->assembly();
        $this->imprimirTablaObjcode($step2->intermediate);
        print_r($visitor->tabSim);
        return $visitor->lines;
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

    function imprimirTabla($datos)
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
        file_put_contents('tabla.txt', $out);
    }

    function imprimirTablaObjcode($datos)
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
        file_put_contents('tablaobjCode.txt', $out);
    }
}

(new Assembler)->run($argv);