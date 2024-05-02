<?php
namespace Assembler;

enum ASMError : string
{
    case sintax = "@Error de sintaxis";
    case labelDuplicated = "@Simbolo duplicado";
    case notExistingOpCode = "@Instruccion no existe";
    //step 2
    case labelNotFound = "@Simbolo no encontrado en TABSIM";
    case opOutOfRange = "@Operando fuera de rango";
    case notExistingAddrMode = "@No existe combinacion MD";
    case notOpOrBaseRelative = "@No relativo al PC/B";
    case symbolNotFound = "@Simbolo no encontrado para END";
    
};

enum Line : int
{
    case INSTRUCTION = 1;
    case DIRECTIVE = 2;
    case HEADER = 3;
    case END = 4;
}

enum NUM : int
{
    case HEX = 0;
    case INT = 1;
}

enum Mode: string
{   //por defecto directos solo si $c existe
    case simple = '030';
    case indirecto = '020';
    case inmediato = '010';
    //modificadores
    case relativoPC = '002';
    case relativoB = '004';
    case indice = '008';
    //podria requerir otro manejo 
    case directo = '001';//solo configura el bit 'e' formato 4

    public function getFlags($modifiers): string
    {

        $flag = $this->value;
        foreach($modifiers as $modifier) {
            $flag = dechex(hexdec($flag) | hexdec($modifier?->value ?? $modifier));
        };
        return $flag;
    }

    public static function getMode($mode): self
    {
        return match($mode) {
            '#' => Mode::inmediato,
            '@' => Mode::indirecto,
            default => Mode::simple,
        };
    }

    public function toString()
    {
        return match($this) {
            null || false => '---',
            Mode::simple => 'Simple',
            Mode::indirecto => 'Indirecto',
            Mode::inmediato => 'Inmediato',
            Mode::relativoPC => 'Relativo al Contador',
            Mode::relativoB => 'Relativo a la Base',
            Mode::indice => 'Indice',
            Mode::directo => 'Directo f4',
            default => '---'
        };
    }
}