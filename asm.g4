grammar asm;

prog: begin lines;

begin: ID? START NUM NEWL #beginProg;

lines: line (NEWL line)*;

line:
    (ID? instruction | ID? directive | end) NEWL?
    ;

instruction: 
    PLUS? opcode (operand1 COMMA operand2?)? #instruction_
    // | PLUS? opcode operand1 COMMA {notifyErrorListeners("Operador derecho no encontrado");} #op2Error
    // | PLUS? opcode COMMA operand2 {notifyErrorListeners("Operador izquierdo no encontrado");} #op1Error
    // | PLUS? opcode COMMA {notifyErrorListeners("Operadores no encontrados");} #commaError
    // | PLUS? opcode operand1 operand2 {notifyErrorListeners("Coma no encontrada");} #noCommaError
    
    ;

opcode: ID;
operand1: (AT|HASH)? (ID|NUM);
operand2: (ID|NUM);

directive: type #directive_;

type: BYTE (CONS|CONSX) #byte
    | WORD NUM          #word
    | RESB NUM          #resb
    | RESW NUM          #resw
    | BASE ID           #base
    ;

end: END (ID|NUM)? NEWL? #endProg;

// lexer rules
START: 'START'; END: 'END';
BYTE: 'BYTE'; WORD: 'WORD'; RESB: 'RESB'; RESW: 'RESW';
PLUS: '+'; HASH: '#'; AT: '@'; COMMA: ',';
BASE: 'BASE';
CONS: 'C\''[a-zA-Z0-9]+'\'';
CONSX: 'X\''[0-9A-F]+'\'';
ID: [A-Z]+[0-9]*;
NUM: [0-9]+'H'?;
NEWL: ('\r'? '\n')+;
WS: [ \t]+ -> skip;
