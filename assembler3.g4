grammar assembler3;

prog: begin lines;

begin: ID? START NUM NEWL#beginProg;

lines: line (NEWL line)*
    ;

line: ID? instruction #instructionOpt
    | ID? directive   #directiveOpt
    | end             #endOpt
    ;

instruction
    : PLUS? ID (AT|HASH)? (ID|NUM) (COMMA (ID|NUM))? #instruction_
    // | PLUS? OPCODE (AT|HASH)? (ID|NUM) #instruction2_
    // | m0 #m0
    // | m1 #op2Error
    // | m2 #op1Error
    // | m3 #commaError
    // | m4 #noCommaError
    ;
// m0: ID COMMA (ID|NUM) NEWL;     
// m1: ((ID|NUM) COMMA) { $parser->notifyErrorListeners("Operador derecho no encontrado"); } ;
// m2: (COMMA (ID|NUM)) { $parser->notifyErrorListeners("Operador izquierdo no encontrado"); } ;
// m3: (ID|NUM) (ID|NUM)  { $parser->notifyErrorListeners("Operadores no encontrados"); } ;
// m4: COMMA { $parser->notifyErrorListeners("Coma no encontrada"); } ;


// instruction: f1 | f2 | f3 |f4 | f5;

// f1    : ID? PLUS? ID (AT|HASH)? (ID|NUM) (COMMA (ID|NUM))? #instruction_;

// f2: ID? PLUS? ID (AT|HASH)? (ID|NUM) COMMA { $parser->notifyErrorListeners("Operador derecho no encontrado"); } #op2Error ;
// f3: ID? PLUS? ID (AT|HASH)? COMMA (ID|NUM) { $parser->notifyErrorListeners("Operador izquierdo no encontrado"); } #op1Error;
// f4: ID? PLUS? ID (AT|HASH)? COMMA  { $parser->notifyErrorListeners("Operadores no encontrados"); } #commaError;
// f5: ID? PLUS? ID (AT|HASH)? (ID|NUM) (ID|NUM) { $parser->notifyErrorListeners("Coma no encontrada"); } #noCommaError;



// instruction: '+'?ID ('@'|'#')? (ID|NUM)(',' (ID|NUM))? #instruction_;

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
ID: ([A-Z]+[0-9]*);
OPCODE: [A-Z]+;
NUM: [0-9]+'H'?;
NEWL: ('\r'? '\n')+;
WS: [ \t]+ -> skip;