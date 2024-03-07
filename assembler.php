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
require_once(__DIR__."/src/errores.php");

class AssemblerErrorListener extends BaseErrorListener {
    public function syntaxError(Recognizer $recognizer, ?object $offendingSymbol, int $line, int $charPositionInLine, string $msg, ?RecognitionException $exception): void
    {
        $map = $recognizer->getTokenTypeMap();
        $rules = $recognizer->getRuleIndexMap();
        $names = $recognizer->getRuleNames();
        // var_dump($map);
        // var_dump($names);
        // var_dump($rules);
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
        print_r($visitor->getIntermediate());
        $this->imprimirTabla($visitor->getIntermediate());
        print_r($visitor->tabSim);
        return $visitor->lines;
    }


    function imprimirTabla($datos)
    {
        // Encabezado
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
            // Guardar en un archivo
        file_put_contents('tabla.txt', $out);
    }
}

(new Assembler)->run($argv);