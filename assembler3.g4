grammar assembler3;

prog: begin lines;

begin: ID START NUM NEWL#beginProg;

lines: line (NEWL line)*
    ;

line:
      ID comma_missing {$parser->notifyErrorListeners("Operadores mal formateados");} #commaMissing
    | (ID?|{false;}) instruction #instructionOpt
    | ID? directive   #directiveOpt
    | op1_missing {$parser->notifyErrorListeners("Operadores mal formateados");}#op1Missing
    | op2_missing {$parser->notifyErrorListeners("Operadores mal formateados");} #op2Missing
    | both_missing {$parser->notifyErrorListeners("Operadores mal formateados");} #bothMissing
    | end             #endOpt
    ;

oneOpCode: ID;

instruction
    // : PLUS? (ID (AT|HASH)? (ID|NUM) (COMMA (ID|NUM))? | ID (ID|NUM)) #instruction_
    : PLUS? ID ((AT|HASH)? op1=(ID|NUM) (COMMA op2=(ID|NUM))?)? #instruction_
    // | PLUS? OPCODE (AT|HASH)? (ID|NUM) #instruction2_
    ;

op1_missing:   ID? PLUS? ID (AT|HASH)? no_op1 COMMA (ID|NUM);
op2_missing:   ID? PLUS? ID (AT|HASH)? (ID|NUM) COMMA no_op2;
both_missing:  ID? PLUS? ID (AT|HASH)? no_op2 COMMA no_op2;
comma_missing: PLUS? ID (AT|HASH)? (ID|NUM) (ID|NUM);
no_op1: {false;};
no_op2: {false;};//(ID|{false})
no_comma: {false;};

directive: type #directive_;

type:
    BYTE (ERRCONS|ERRCONSX) {$parser->notifyErrorListeners("en directiva BYTE");} #byteError 
    |BYTE (CONS|CONSX) #byte
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
ERRCONS: [A-BD-Za-z]'\''[a-zA-Z0-9]+'\'' 
| [A-Za-z]('\''[a-zA-Z0-9]+|[a-zA-Z0-9]+'\'');
ERRCONSX: [A-WY-Za-z]'\''[0-9A-Za-z]+'\'' | [A-Za-z]('\''[0-9A-Za-z]+|[0-9A-Za-z]+'\'');
ID: ([A-Z]+[0-9]*);
OPCODE: [A-Z]+;
NUM: [0-9]+('H')?;
NEWL: ('\r'? '\n')+;
WS: [ \t]+ -> skip;