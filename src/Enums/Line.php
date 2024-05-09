<?php

namespace Assembler\Enums;

enum Line : int
{
    case INSTRUCTION = 1;
    case DIRECTIVE = 2;
    case HEADER = 3;
    case END = 4;
}