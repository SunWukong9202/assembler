grammar assembler;

programa: inicio preposiciones fin #Begin;

inicio: etiqueta START NUM FINL #BeginStart
      | preposicion             #BeginProp
      ;

fin: END entrada FINL           #EndLine
   | END entrada                #EndInput
   ;

entrada: ID                     //#Id
       | E                      //#Ee
       ;

preposiciones: preposiciones preposicion  #Prepositions
             | preposicion               #OptPreposition
             ;

preposicion: instruccion                 //#Preposition
           | directiva                   //#OptDirective
           ;

instruccion: etiqueta opinstruccion FINL #Instruction;

directiva: etiqueta tipodirectiva opdirectiva FINL #Directive;

tipodirectiva: BYTE #Byte
             | WORD #Word
             | RESB #Resb
             | RESW #Resw
             ;

etiqueta: ID #Label
        | E  #EmptyLabel
        ;

opinstruccion: formato 
              | E
             ;

formato: f1 #FormatOne 
       | f2 #FormatTwo
       | f3 #FormatThree
       | f4 #FormatFour
       ;

f1: CODOP;

f2: CODOP NUM
  | CODOP REG
  | CODOP REG','REG
  | CODOP REG','NUM
  ;

f3: simple3 
  | indirecto3 
  | inmediato3 
  ;

f4: '+'f3;

simple3: CODOP ID #sim1
       | CODOP NUM #sim2
       | CODOP NUM ','X #sim3
       | CODOP ID ','X #sim4
       ;

indirecto3: CODOP '@'NUM #ind1
          | CODOP '@'ID #ind2
          ;

inmediato3: CODOP '#'NUM #inm1
          | CODOP '#'ID #inm2
          ;

opdirectiva: NUM
           | CONSTHEX
           | CONSTCAD
           ;

// Lexer rules
START: 'START';
NUM: [0-9]+'H'?;
FINL: '\r'? '\n';
E: '\r'? '\n';
END: 'END';
CODOP: [A-Z]+;
ID: [A-Z]+[0-9]*;
BYTE: 'BYTE';
WORD: 'WORD';
RESB: 'RESB';
RESW: 'RESW';
REG: 'r'[1-16] | [A-Z];
X: 'X';
INDICE: [0-9];
CONSTHEX: 'X\''[0-9A-F]+'\'';
CONSTCAD: 'C\''[0-9a-zA-Z]+'\'';
WS: [ ]+ -> skip;



