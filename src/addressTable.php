<?php
namespace Assembler;

class AddressModes
{
    $table = [
        'Simple' => [
            ''
        ],
    ]
Simple 0 0 0 0 0 0 1 1 0 0 0 0 op c desp (TA) D
       0 0 0 0 0 0 1 1 0 0 0 1 +op m dir (TA) 4 D
       0 0 0 0 0 0 1 1 0 0 1 0 op m (CP) + desp (TA) A
       0 0 0 0 0 0 1 1 0 1 0 0 op m (B) + desp (TA) A
       0 0 0 0 0 0 1 1 1 0 0 0 op c,X desp + (X) (TA) D
       0 0 0 0 0 0 1 1 1 0 0 1 +op m,X dir + (X) (TA) 4 D
       0 0 0 0 0 0 1 1 1 0 1 0 op m,X (CP)+desp+(X) (TA) A
       0 0 0 0 0 0 1 1 1 1 0 0 op m,X (B)+desp+(X) (TA) A
       0 0 0 0 0 0 0 0 0 - - - op m b/p/e/desp (TA) D S
       0 0 0 0 0 0 0 0 1 - - - op m, X b/p/e/desp+(X) (TA) D S
Indirecto 1 0 0 0 0 0 op @c desp ((TA)) D
          1 0 0 0 0 1 +op @m dir ((TA)) 4 D
          1 0 0 0 1 0 op @m (CP) + desp ((TA)) A
          1 0 0 1 0 0 op @m (B) + desp ((TA)) A
Inmediato 0 1 0 0 0 0 op #c desp TA D
          0 1 0 0 0 1 +op #m dir TA 4 D
          0 1 0 0 1 0 op #m (PC) + desp TA A
          0 1 0 1 0 0 op #m (B) + desp TA A
}