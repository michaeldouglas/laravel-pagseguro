<?php

require_once __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use laravel\pagseguro\Request\PaymentRequest,
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
    'type' => 'BRL'
);

/**
 * Fora da estrutura do Laravel
 */
try {
    $credentials = new Credentials('43ECEAEB8DBD4DC7B240E22DBA6540D2', 'michaeldouglas010790@gmail.com');
    $request = new PaymentRequest($credentials);
    $request->setRequest($dados);
    
    print $request->sendRequest();
    
    /*echo "<h1>Items</h1>";
    echo '<pre>',print_r($request->getItems(), 1),'</pre>';
    echo "<hr />";
    
    echo "<h1>Endereço</h1>";
    echo '<pre>',print_r($request->getAddress(), 1),'</pre>';
    echo "<hr />";
    
    echo "<h1>Remetente</h1>";
    echo '<pre>',print_r($request->getSender(), 1),'</pre>';
    echo "<hr />";*/
    
} catch (\Exception $e) {
    print_r($e->getMessage());
}

/**
 * Em Laravel
 * 
 * PagSeguro::setRequest($dados);
 * echo '<pre>', print_r(PagSeguro::getPaymentItems(), 1), '</pre>';
 * 
 */