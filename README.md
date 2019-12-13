## Laravel PagSeguro - 1.0.6

<p align="center"><img src="https://atitude-files.s3-sa-east-1.amazonaws.com/laravel_pagseguro.png" width="200"></p>

<p align="center">

[![Build Status](https://travis-ci.org/michaeldouglas/laravel-pagseguro.svg?branch=master)](https://travis-ci.org/michaeldouglas/laravel-pagseguro)
[![Total Downloads](https://poser.pugx.org/michael/laravelpagseguro/downloads)](https://packagist.org/packages/michael/laravelpagseguro)
[![Latest Unstable Version](https://poser.pugx.org/leaphly/cart-bundle/v/unstable.svg)](//packagist.org/packages/michael/laravelpagseguro)
[![License](https://poser.pugx.org/leaphly/cart-bundle/license.svg)](https://packagist.org/packages/michael/laravelpagseguro)
[![Code Climate](https://codeclimate.com/github/michaeldouglas/laravel-pagseguro/badges/gpa.svg)](https://codeclimate.com/github/michaeldouglas/laravel-pagseguro)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/a358a57c8d4f4458b9d9055326f5a67c)](https://www.codacy.com/app/michaeldouglas010790/laravel-pagseguro?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=michaeldouglas/laravel-pagseguro&amp;utm_campaign=Badge_Grade)

</p>

O laravel-pagseguro consome a API do PagSeguro e prove uma forma 
simples de gerar o pagamento, e notificar sobre as suas transações.

## Criação e configuração do usuário
Antes de você utilizar o Laravel PagSeguro é importante você verificar se o seu usuário do PagSeguro está correto para a integração
segue URL de configuração do usuário PagSeguro:
[https://pagseguro.uol.com.br/preferencias/integracoes.jhtml](https://pagseguro.uol.com.br/preferencias/integracoes.jhtml)

## Compatibilidade

 PHP >= 5.4
 Laravel 5.x

## Instalação

Abra o arquivo `composer.json` e insira a seguinte instrução:

    "require": {
        "michael/laravelpagseguro": "dev-master"
    }

**Observação**: Para a versão 5.1 do laravel ou abaixo especifique a versão **0.4.1** ao invés de utilizar **dev-master**

Após inserir no require o `Laravel PagSeguro`, você deverá executar o comando:

    composer update


Ou execute o comando:

    composer require michael/laravelpagseguro:dev-master

## Configuração do Service Provider

Abra o arquivo `config/app.php` e adicione no array `providers` a seguinte instrução:

```php
laravel\pagseguro\Platform\Laravel5\ServiceProvider::class
```

## Aliases do package

Em seu arquivo `config/app.php` adicione no array `aliases` a seguinte instrução:

```php
'PagSeguro' => laravel\pagseguro\Platform\Laravel5\PagSeguro::class
```

## Criação do configurador

Agora você irá executar o comando:

```php
php artisan vendor:publish
```

Se tudo ocorreu bem, a seguinte mensagem sera exibida:

```php
Copied File [/vendor/michael/laravelpagseguro/src/laravel/pagseguro/Config/laravelpagseguro.php] To [/config/laravelpagseguro.php]
```

## Ajuste da configuração

Abra o arquivo `config/laravelpagseguro.php` altere o `token` e também o `e-mail` informando o da sua loja:

```php
    'credentials' => array(//SETA AS CREDENCIAIS DE SUA LOJA
        'token' => null,
        'email' => null,
    )
```

## Proxy

Caso você precise de proxy para utilizar a Laravel PagSeguro descomente e configure a linha de http adapter:

```php
'http' => [
    'adapter' => [
        'type' => 'curl',
        'options' => [
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
            // CURLOPT_PROXY => 'http://user:pass@host:port', // PROXY OPTION <<--
        ]
    ],
],
```

## Exemplo de envio de requisição de compra

O array de envio deverá ser montado com a seguinte estrutura:

```php

$data = [
    'items' => [
        [
            'id' => '18',
            'description' => 'Item Um',
            'quantity' => '1',
            'amount' => '1.15',
            'weight' => '45',
            'shippingCost' => '3.5',
            'width' => '50',
            'height' => '45',
            'length' => '60',
        ],
        [
            'id' => '19',
            'description' => 'Item Dois',
            'quantity' => '1',
            'amount' => '3.15',
            'weight' => '50',
            'shippingCost' => '8.5',
            'width' => '40',
            'height' => '50',
            'length' => '80',
        ],
    ],
    'shipping' => [
        'address' => [
            'postalCode' => '06410030',
            'street' => 'Rua Leonardo Arruda',
            'number' => '12',
            'district' => 'Jardim dos Camargos',
            'city' => 'Barueri',
            'state' => 'SP',
            'country' => 'BRA',
        ],
        'type' => 2,
        'cost' => 30.4,
    ],
    'sender' => [
        'email' => 'sender@gmail.com',
        'name' => 'Isaque de Souza Barbosa',
        'documents' => [
            [
                'number' => '01234567890',
                'type' => 'CPF'
            ]
        ],
        'phone' => [
            'number' => '985445522',
            'areaCode' => '11',
        ],
        'bornDate' => '1988-03-21',
    ]
];
```

Após ter os dados, utilize o método: `createFromArray` para criar o objeto de checkout:

```php
$checkout = PagSeguro::checkout()->createFromArray($data);
```

Para confirmar o envio utilize o método: `send` da seguinte forma:

```php
$checkout = PagSeguro::checkout()->createFromArray($data);
$credentials = PagSeguro::credentials()->get();
$information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
if ($information) {
    print_r($information->getCode());
    print_r($information->getDate());
    print_r($information->getLink());
}
```

Informando metadados de Recarga de celular:

```php
// ....
$data['cellphone_charger'] = '+5511980810000';
$checkout = PagSeguro::checkout()->createFromArray($data);
```

Informando metadados para Dados de viagem:

```php
// ....
$data['travel'] = [
  'passengers' => [
      [
          'name' => 'Isaque de Souza',
          'cpf' => '40404040411',
          'passport' => '4564897987'
      ],
      [
          'name' => 'Michael Douglas',
          'cpf' => '80808080822',
      ]
  ],
  'origin' => [
      'city' => 'SAO PAULO - SP',
      'airportCode' => 'CGH', // Congonhas
  ],
  'destination' => [
      'city' => 'RIO DE JANEIRO - RJ',
      'airportCode' => 'SDU', // Santos Dumont
  ]
];
$checkout = PagSeguro::checkout()->createFromArray($data);
```

Informando metadados para Jogos:

```php
// ....
$data['game'] = [
    'gameName' => 'PS LEGEND',
    'playerId' => 'BR561546S4',
    'timeInGameDays' => 360,
];
$checkout = PagSeguro::checkout()->createFromArray($data);
```

## Credenciais

Para resgatar as credenciais padrões do arquivo você pode usar:

```php
$credentials = PagSeguro::credentials()->get();
```

Ou usar credenciais alternativas

```php
$credentials = PagSeguro::credentials()->create($token, $email);
```

## Consultando uma Transação manualmente

```php
$credentials = PagSeguro::credentials()->get();
$transaction = PagSeguro::transaction()->get($code, $credentials);
$information = $transaction->getInformation();
```

## Recebendo Notificações de Transação

Crie uma rota POST com o nome "pagseguro.notification" (Esta no config)

```php
Route::post('/pagseguro/notification', [
    'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
    'as' => 'pagseguro.notification',
]);
```

Registre um callback (callable) no seu config laravelpagseguro.php

```php
'routes' => [
    'notification' => [
        'callback' => ['MyNotificationClass', 'myMethod'], // Callable
        'credential' => 'default',
        'route-name' => 'pagseguro.notification', // Nome da rota
    ],
],
```

Ou ....

```php
'routes' => [
    'notification' => [
        'callback' => function ($information) { // Callable
            \Log::debug(print_r($information, 1));
        },
    ],
],
```

## Exemplo de callable em uma classe

No arquivo de configuração você deverá deixar da seguinte maneira:

```php
'notification' => [
  'callback' => ['App\Controllers\PagSeguroController', 'Notification'], // Callable callback to Notification function (notificationInfo) : void {}
  'credential' => 'default', // Callable resolve credential function (notificationCode) : Credentials {}
  'route-name' => 'pagseguro.notification', // Criar uma rota com este nome
],
```

E na controller você deverá criar o método, por exemplo, Notification:

```php
public static function Notification($information)
{
    \Log::debug(print_r($information->getStatus()->getCode(), 1));
}
```

## Criação de plano de pagamento recorrente

A criação de plano de pagamento recorrente inicia com a criação do plano e para isso você deverá criar
o seguinte array:

Caso queira ver os objetos de requisição: https://dev.pagseguro.uol.com.br/v1.0/reference#criar-plano

```php
$plan = [
    'body' => [
        'reference' => 'plano laravel pagseguro',
    ],

    'preApproval' => [
        'name' => 'Plano ouro - mensal',
        'charge' => 'AUTO', // outro valor pode ser MANUAL
        'period' => 'MONTHLY', //WEEKLY, BIMONTHLY, TRIMONTHLY, SEMIANNUALLY, YEARLY
        'amountPerPayment' => '125.00', // obrigatório para o charge AUTO - mais que 1.00, menos que 2000.00
        'membershipFee' => '50.00', //opcional - cobrado com primeira parcela
        'trialPeriodDuration' => 30, //opcional
        'details' => 'Decrição do plano', //opcional
        'expiration' => [ // opcional
            'value' => 1, // obrigatório de 1 a 1000000
            'unit' => 'YEARLY', // obrigatório 
        ],
    ]

];
```

E então você deverá chamar o método de criação do plano:

```php
$plan = \PagSeguro::plan()->createFromArray($plan);
$credentials = \PagSeguro::credentials()->get();
$information = $plan->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
if ($information) {
  print_r($information->getCode());
  print_r($information->getDate());
  print_r($information->getLink());
}
```

## Licença

O Laravel PagSeguro utiliza a licença MIT, para saber mais leia no link: [MIT license](http://opensource.org/licenses/MIT)
