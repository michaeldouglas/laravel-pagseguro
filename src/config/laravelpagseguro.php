<?php
return array(
    'credentials' => [//SETA AS CREDENCIAIS DE SUA LOJA
        'email' => null,
        'token' => null,
    ],
    'currency' => [//MOEDA QUE SERÁ UTILIZADA COMO MEIO DE PAGAMENTO
        'type' => 'BRL'
    ],
    'reference' => [//CRIAR UMA REFERENCIA PARA OS PRODUTOS VENDIDOS
        'idReference' => null
    ],
    'url' => 'https://ws.pagseguro.uol.com.br/v2/checkout',
);