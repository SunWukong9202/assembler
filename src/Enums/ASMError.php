<?php

namespace Assembler\Enums;

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
