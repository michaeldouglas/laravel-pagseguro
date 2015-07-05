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
        'senderName' => 'Levina Do Nascimento Passos',
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

/**
 * Fora da estrutura do Laravel
 */
try {
    $credentials = new Credentials('43ECEAEB8DBD4DC7B240E22DBA6540D2', 'michaeldouglas010790@gmail.com');
    $request = new PaymentRequest($credentials);
    $request->setRequest($dados)->sendRequest();
    $code = $request->request->getCode();
    
    echo "<a target=\"_blank\" href=\"https://pagseguro.uol.com.br/v2/checkout/payment.html?code=$code\"> Pagamento </a>";
    
    /* 
     * echo "<h1>Items</h1>";
    
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
 * $request = PagSeguro::setRequest($dados);
 * $request->sendRequest();
 * $code = $request->request->getCode();
 * echo "<a target=\"_blank\" href=\"https://pagseguro.uol.com.br/v2/checkout/payment.html?code=$code\"> Pagamento </a>";
 * 
 */