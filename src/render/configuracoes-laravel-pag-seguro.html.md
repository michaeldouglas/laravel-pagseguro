---
title: Documentação oficial Laravel PagSeguro - Configurações da Laravel Pag Seguro
subtitle: Parâmetros de configuração da biblioteca Laravel Pag Seguro
layout: main
---

Normalmente quando estamos em um ambiente corporativo precisamos utilizar proxy para navegar na internet. A
Laravel Pag Seguro vem com uma simples configuração de proxy através do arquivo **config/laravelpagseguro.php**.

Nesse arquivo é que definimos a utilização de proxy. Abra o arquivo **config/laravelpagseguro.php** e veja o conteúdo
delete, ele deve estar com o seguinte código:

#### Não se preocupe em entender o código pois no final dele existe uma tabela explicando cada item

```
<?php
return [
    'use-sandbox' => false,

    'credentials' => [
        'email' => null,
        'token' => null,
    ],
    'routes' => [
        'redirect' => [
            'route-name' => 'pagseguro.redirect',
        ],
        'notification' => [
            'callback' => null,
            'credential' => 'default',
            'route-name' => 'pagseguro.notification',
        ],
    ],
    'currency' => [
        'type' => 'BRL'
    ],
    'http' => [
        'adapter' => [
            'type' => 'curl',
            'options' => [
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
                //CURLOPT_PROXY => 'http://user:pass@host:port', // PROXY OPTION
            ]
        ],
    ],
    'host' => [
        'production' => 'https://ws.pagseguro.uol.com.br',
        'sandbox' => 'https://ws.sandbox.pagseguro.uol.com.br'
    ],
    'url' => [
        'checkout' => '/v2/checkout',
        'transactions' => '/v3/transactions',
        'transactions-notifications' => '/v3/transactions/notifications',
        'transactions-history' => '/v2/transactions',
        'transactions-abandoned' => '/v2/transactions/abandoned',
    ],
];

```

A seguir iremos explicar item por item dessas configurações. Perceba que cada item é relacionado diretamente com
as opções que o próprio PagSeguro nos fornece.

|Chave pai|Chave do array|Valor aceito| Descrição|Ajuda|
|--------------|------------|----------|---------------|
|**Não possui**|use-sandbox|Boleano (true/false) |Esse item é utilizado para indicar se as transações realizadas serão testes. Se **true** todas transações serão enviadas para o servidor de testes do Pag Seguro, ou seja, nenhuma compra efetivamente será realizada. Para utilizar o ambiente de produção e realizar transações defina esse item como **false**|-|
|**credential**|email|string|Utilizamos esse item para realizar a autenticação das transações das suas compras com a Laravel Pag Seguro. O email aqui deve vir da sua conta cadastrada no Pag Seguro|[Não sabe como conseguir as credenciais ? Clique aqui](http://teste)|
|**credential**|token|string|Token fornecido pelo Pag Seguro|[Não sabe como conseguir as credenciais ? Clique aqui](http://teste)|
|**routes**|redirect|string|||
|**redirect**|route-name|string|||
|**routes**|notification|string|||
|**notification**|callback|string|||
|**notification**|credential|string|||
|**notification**|route-name|string|||

