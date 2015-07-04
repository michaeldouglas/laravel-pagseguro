## Laravel PagSeguro

[![Build Status](https://travis-ci.org/michaeldouglas/laravel-pagseguro.svg?branch=master)](https://travis-ci.org/michaeldouglas/laravel-pagseguro)
[![Latest Unstable Version](https://poser.pugx.org/leaphly/cart-bundle/v/unstable.svg)](//packagist.org/packages/michael/laravelpagseguro)
[![License](https://poser.pugx.org/leaphly/cart-bundle/license.svg)](https://packagist.org/packages/michael/laravelpagseguro)
[![Code Climate](https://codeclimate.com/github/michaeldouglas/laravel-pagseguro/badges/gpa.svg)](https://codeclimate.com/github/michaeldouglas/laravel-pagseguro)
[![Codacy Badge](https://www.codacy.com/project/badge/a358a57c8d4f4458b9d9055326f5a67c)](https://www.codacy.com/app/michaeldouglas010790/laravel-pagseguro)

O laravel-pagseguro consome a API do PagSeguro e prove uma forma 
simples de gerar o pagamento, a notificação e as transações de sua loja ou etc.

## Manual PagSeguro
[http://download.uol.com.br/pagseguro/docs/pagseguro-checkout-transparente.pdf](http://download.uol.com.br/pagseguro/docs/pagseguro-checkout-transparente.pdf)


## Laravel compatibilidade

 Laravel  | Traduzível
:---------|:----------
 5.0.x    | 5.1.x
 4.2.x    | 4.4.x
 4.1.x    | 4.4.x

## Instalação

Abra o arquivo `composer.json` e insira a seguinte instrução:

    "require": {
        "michael/laravelpagseguro": "dev-master"
    }

Após inserir no require o `Laravel PagSeguro`, você deverá executar o comando:

    composer update


Ou execute o comando:

    composer require michael/laravelpagseguro

## Configuração do Service Provider

Abra o arquivo `config/app.php` e adicione no array `providers` a seguinte instrução:

```php
laravel\pagseguro\PagseguroServiceProvider::class
```

## Aliases do package

Em seu arquivo `config/app.php` adicione no array `aliases` a seguinte instrução:

```php
'PagSeguro' => laravel\pagseguro\Facades\PagSeguro::class
```

## Criação do configurador

Agora você irá executar o comando:

```php
php artisan vendor:publish
```

Se tudo ocorreu bem, a seguinte mensagem sera exibida:

```php
Copied File [/vendor/michael/laravelpagseguro/src/laravel/pagseguro/config/laravelpagseguro.php] To [/config/laravelpagseguro.php]
```

## Ajuste da configuração

Abra o arquivo `config/laravelpagseguro.php` altere o `token` e também o `e-mail` informando o da sua loja:

```php
    'credentials' => array(//SETA AS CREDENCIAIS DE SUA LOJA
        'token' => null,
        'email' => null,
    )
```

## Exemplo de envio de requisição de compra

O array de envio deverá ser montado com a seguinte estrutura:

```php
$dados = array(
    'items' => array(
        'itemId1' => array(
            'itemId1' => '0001',
            'itemDescription1' => 'Notebook Prata 1',
            'itemQuantity1' => '1',
            'itemAmount1' => '10.00',
            'itemWeight1' => '1000',
            'itemShippingCost1' => null
        ),
        'itemId2' => array(
            'itemId2' => '0002',
            'itemDescription2' => 'Notebook Prata 2',
            'itemQuantity2' => '2',
            'itemAmount2' => '5.00',
            'itemWeight2' => '100',
            'itemShippingCost2' => null
        )
    ),
    'address' => array(
        'postalCode' => '04433130',
        'street' => 'Rua benjamin vieira da silva',
        'number' => '1077',
        'complement' => '',
        'district' => 'Centro',
        'city' => 'São Paulo',
        'state' => 'SP',
        'country' => 'BRA',
    ),
    'sender' => array(
        'name' => 'Teste do comprador',
        'email' => 'michael.araujo@idealinvest.com.br',
        'phone' => [
            'areaCode' => 11,
            'number' => '5614-9351',
        ],
        'documents' => [
            [
                'type' => 'CPF',
                'number' => '31985741539',
            ]
        ],
    ),
    'currency' => 'BRL'
);
```

Após setar o array, utilize o método: `setRequest` para criar a requisição de envio:

```php
$request = PagSeguro::setRequest($dados);
```

Para confirmar o envio utilize o método: `sendRequest` da seguinte forma:

```php
$request->sendRequest();
```

Para obter o código de retorno da compra, utilize o método: `getCode` sob o objeto `request` que é responsável pela sua requisição:
 
```php
$code = $request->request->getCode();
```

## Exemplo de URL de requisição com a variável `$code`

```php
echo "<a target=\"_blank\" href=\"https://pagseguro.uol.com.br/v2/checkout/payment.html?code=$code\"> Pagamento </a>"; 
```

## Licença

O Laravel PagSeguro utiliza a licença MIT, para saber mais leia no link: [MIT license](http://opensource.org/licenses/MIT)
