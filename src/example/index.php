<?php

require_once __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use laravel\pagseguro\Request\PaymentRequest,
    laravel\pagseguro\Credentials\Credentials;

$dados = array(
    'items' => array(
        'itemId1' => array(
            'itemId1' => '0001',
            'itemDescription1' => 'Notebook Prata 1as',
            'itemQuantity1' => '1',
            'itemAmount1' => '12.00',
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
        'senderName' => 'Teste de compra',
        'senderCPF' => '27781466870',
        'senderEmail' => 'itteste@test.com',
        'phone' => [
            'areacode' => '11',
            'number' => '5614-9399',
        ],
    ),
    'currency' => 'BRL'
);

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><checkout />');
$xml->addChild('currency', 'BRL');
$xml->addChild('items', '<item><id>1</id></item><item><id>2</id></item>');
echo $xml->asXML();