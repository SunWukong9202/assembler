<?php
namespace Assembler;

class TabSim 
{
    protected $instructions = [];
    protected $table;

    public function __construct()
    {
        $this->instructions = require(__DIR__."/../instructionSet.php");
        $this->table = [];
    }

    // public function insert(mixed $label, $error): void
    // {
    //     if(!isset($label)) return;
    //     if(isset($this->table[$label->getText()])) {
    //         // $error = "@Error en la linea {$this->lines}: Simbolo Duplicado\n";
    //         if($this->printErrors) echo $error;
    //         $this->putErrorLine($error);
    //     }
    //     else {
    //         $pc = $this->ajustHexLength(dechex($this->pc), 6);
    //         $this->tabSim[$label->getText()] = $pc;
    //     }
    // }

}