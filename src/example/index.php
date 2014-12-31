<?php

require_once __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);

$dados = array(
    'items' => array(
        'item1' => array(
            'id' => '0001',
            'description' => 'Notebook Prata',
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
    )
);


$p = new laravel\pagseguro\Payment;

try{
    $p->setAddItem($dados);
    echo "<pre> - - ";
    print_r($p->getPaymentItems());
}  catch (\Exception $e){
    print_r($e);
}