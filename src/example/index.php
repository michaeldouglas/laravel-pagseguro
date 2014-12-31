<?php
require_once __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors','On');
error_reporting(E_ALL);

$dados = array(
    // -> PRODUTO
    'email' => 'michaeldouglas010790@gmail.com',
    'token' => '65821CECD6304779B7570BA2D06AD953',
    'currency' => 'BRL',
    'itemId1' => '0001',
    'itemDescription1' => 'Notebook Prata',
    'itemAmount1' => '10.00',
    'itemQuantity1' => '1',
    'itemWeight1' => '1000',
    'reference' => 'REF1234',
    'senderName' => 'Michael Teste de Pagamento',
    'senderAreaCode' => '11',
    'senderPhone' => '56273440',
    'senderEmail' => 'michael.araujo@idealinvest.com.br',
    'shippingType' => '1',
    'shippingAddressStreet' => 'Av. Brig. Faria Lima',
    'shippingAddressNumber' => '1384',
    'shippingAddressComplement' => '5o andar',
    'shippingAddressDistrict' => 'Jardim Paulistano',
    'shippingAddressPostalCode' => '01452002',
    'shippingAddressCity' => 'Sao Paulo',
    'shippingAddressState' => 'SP',
    'shippingAddressCountry' => 'BRA'
);

$p = new laravel\pagseguro\payment;

echo 'Teste - 1';

/*
$url = "https://ws.pagseguro.uol.com.br/v2/checkout";
$response = \Httpful\Request::post($url)
        ->body(http_build_query($dados))
        ->expectsXml()
        ->sendsType('application/x-www-form-urlencoded')
        ->send();


$codeCompra = (string) $response->body->code[0];

echo "<a href=\"https://pagseguro.uol.com.br/v2/checkout/payment.html?code={$codeCompra}\">Redirecionar</a>";
 * */