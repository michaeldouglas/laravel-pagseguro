<?php

require_once __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use laravel\pagseguro\Payment\PaymentRequest,
    laravel\pagseguro\Credentials\Credentials;

$dados = array(
    'items' => array(
        'item1' => array(
            'id' => '0001',
            'description' => 'Notebook Prata 1',
            'quantity' => '1',
            'amount' => '10.00',
            'weight' => '1000',
            'shippingCost' => null
        ),
        'item2' => array(
            'id' => '0002',
            'description' => 'Notebook Prata 2',
            'quantity' => '2',
            'amount' => '5.00',
            'weight' => '100',
            'shippingCost' => null
        )
    ),
    'address' => array(
        'cep' => '04433130',
        'rua' => 'Rua benjamin vieira da silva',
        'numero' => '1077',
        'complemento' => '',
        'bairro' => 'Centro',
        'cidade' => 'São Paulo',
        'estado' => 'SP',
        'pais' => 'BRA',
    ),
    'sender' => array(
        'nome' => 'Teste do comprador',
        'email' => 'michael.araujo@idealinvest.com.br',
        'codarea' => 11,
        'numero' => '5614-9351',
        'doctipo' => 'CPF',
        'docnum' => '319.857.415-39',
    )
);
$PaymentRequest = new PaymentRequest;
try {
    $credentials = new Credentials('65821CECD6304779B7570BA2D06AD953', 'michaeldouglas010790@gmail.com');
    $PaymentRequest->setPaymentRequest($dados, $credentials);
    echo '<pre>',print_r($PaymentRequest->getPaymentItems(),1),'</pre>';
} catch (\Exception $e) {
    print_r($e->getMessage());
}