grammar assembler2;

prog: begin lines end;

begin: LABEL? START NUM NEWL;

lines: line NEWL?
    |  lines NEWL line
    ;

line: LABEL? instruction
    | LABEL? directive
    ;

instruction: format NEWL;

format: f1
    |   f2
    |   f3
    |   f4
    ;

f1: OPCODE;

f2: OPCODE REG (',' REG)?;

// simple,  indirect, immediate
f3: simple
    | indirect
    | immediate
    ;

simple: OPCODE ADDR(',' X);

indirect: '@'ADDR;

immediate: '#'ADDR;

f4: '+'f3;

directive: type NEWL;

type: BYTE (CONS|CONSX)
    | WORD NUM
    | RESB NUM
    | RESW NUM
    ;

end: END LABEL? NEWL?;

// lexer rules
START: 'START'; END: 'END'; X: 'X';
BYTE: 'BYTE'; WORD: 'WORD'; RESB: 'RESB'; RESW: 'RESW';
CONS: 'C\''[a-zA-Z0-9]+'\'';
CONSX: 'X\''[0-9A-F]+'\'';
LABEL: ([A-Z]+[0-9]+);
REG: [A-Z];
OPCODE: [A-Z]+;
NUM: [0-9]+'H'?;
ADDR: (NUM | [A-Z]+[0-9]+);
NEWL: ('\r'? '\n')+;
WS: [ \t]+ -> skip;

// fec compacto