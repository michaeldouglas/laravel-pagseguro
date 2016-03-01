## Laravel PagSeguro - 1.0

[![Build Status](https://travis-ci.org/michaeldouglas/laravel-pagseguro.svg?branch=master)](https://travis-ci.org/michaeldouglas/laravel-pagseguro)
[![Total Downloads](https://poser.pugx.org/michael/laravelpagseguro/downloads)](https://packagist.org/packages/michael/laravelpagseguro)
[![Latest Unstable Version](https://poser.pugx.org/leaphly/cart-bundle/v/unstable.svg)](//packagist.org/packages/michael/laravelpagseguro)
[![License](https://poser.pugx.org/leaphly/cart-bundle/license.svg)](https://packagist.org/packages/michael/laravelpagseguro)
[![Code Climate](https://codeclimate.com/github/michaeldouglas/laravel-pagseguro/badges/gpa.svg)](https://codeclimate.com/github/michaeldouglas/laravel-pagseguro)
[![Codacy Badge](https://www.codacy.com/project/badge/a358a57c8d4f4458b9d9055326f5a67c)](https://www.codacy.com/app/michaeldouglas010790/laravel-pagseguro)

O laravel-pagseguro consome a API do PagSeguro e prove uma forma 
simples de gerar o pagamento, e notificar sobre as suas transações.

## Criação e configuração do usuário
Antes de você utilizar o Laravel PagSeguro é importante você verificar se o seu usuário do PagSeguro está correto para a integração
segue URL de configuração do usuário PagSeguro:
[https://pagseguro.uol.com.br/preferencias/integracoes.jhtml](https://pagseguro.uol.com.br/preferencias/integracoes.jhtml)

## Compatibilidade

 PHP >= 5.4.0
 Laravel 5.x

## Instalação

Abra o arquivo `composer.json` e insira a seguinte instrução:

    "require": {
        "michael/laravelpagseguro": "1.0.0"
    }

Após inserir no require o `Laravel PagSeguro`, você deverá executar o comando:

    composer update


Ou execute o comando:

    composer require michael/laravelpagseguro

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
        'phone' => '11985445522',
        'bornDate' => '1988-03-21',
    ]
];
```

Após setar o array, utilize o método: `createCheckoutFromArray` para criar a requisição de envio:

```php
$request = PagSeguro::createCheckoutFromArray($data);
```

Para confirmar o envio utilize o método: `send` da seguinte forma:

```php
$information = $request->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
if ($information) {
    print_r($information->getCode());
    print_r($information->getDate());
    print_r($information->getLink());
}
```

Para resgatar as credenciais padrões do arquivo você pode usar:

```php
$credentials = PagSeguro::getCredentials();
```

Ou usar credenciais alternativas

```php
$credentials = PagSeguro::createCredentials($token, $email);
```
## Licença

O Laravel PagSeguro utiliza a licença MIT, para saber mais leia no link: [MIT license](http://opensource.org/licenses/MIT)
