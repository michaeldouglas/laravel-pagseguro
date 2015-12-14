<?php

return [
    'sandbox' => FALSE,//DEFINI SE SERÁ UTILIZADO O AMBIENTE DE TESTES
    
    'credentials' => [//SETA AS CREDENCIAIS DE SUA LOJA
        'email' => NULL,
        'token' => NULL,
    ],
    'currency' => [//MOEDA QUE SERÁ UTILIZADA COMO MEIO DE PAGAMENTO
        'type' => 'BRL'
    ],
    'reference' => [//CRIAR UMA REFERENCIA PARA OS PRODUTOS VENDIDOS
        'idReference' => NULL
    ],
    'proxy' => [//CONFIGURAÇÃO PARA PROXY
        'user'     => NULL,
        'password' => NULL,
        'url'      => NULL,
        'port'     => NULL,
        'protocol' => NULL
    ],
    'url' => 'https://ws.pagseguro.uol.com.br/v2/checkout',
];
