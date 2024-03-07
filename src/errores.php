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
    case notExistingAddrMode = "@Modo de direccion no existe";
    case notOpRelative = "@No relativo al PC";
    case notBaseRelative = "@No relativo a la Base";
    case symbolNotFound = "@Simbolo no encontrado para END";
};

enum Line : int
{
    case INSTRUCTION = 1;
    case DIRECTIVE = 2;
    case HEADER = 3;
    case END = 4;
}

enum Mode: string
{   //por defecto directos si solo $c existe
    case simple = '030';
    case indirecto = '020';
    case inmediato = '010';
    //modificadores
    case relativoPC = '002';
    case relativoB = '004';
    case indice = '008';
    //podria requerir otro manejo 
    case directo = '001';//solo configura el bit 'e' formato 4

    public function getFlags(...$modifiers): void
    {
        $flag = $this->value;
        foreach($modifiers as $modifier) {
            $flag = $flag | $modifier;
        };
    }

    public static function getMode($string): static
    {
        return match($string) {
            '#' => static::inmediato,
            '@' => static::indirecto,
            default => static::simple
        };
    }

    function ajustHexLength($hex, $length = 3) {
        // Agregar ceros a la izquierda hasta alcanzar la longitud deseada
        $adjustedHex = str_pad($hex, $length, '0', STR_PAD_LEFT);
        return $adjustedHex;
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