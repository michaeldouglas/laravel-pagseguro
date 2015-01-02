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
    ),
    'address' => array(
        'cep'         => '04433130',
        'rua'         => 'Rua benjamin vieira da silva',
        'numero'      => '1077',
        'complemento' => '',
        'bairro'      => 'Centro',
        'cidade'      => 'São Paulo',
        'estado'      => 'SP',
        'pais'        => 'BRA',
    )
);

$payment = new laravel\pagseguro\Payment;
try{
    $credentials = new laravel\pagseguro\Credentials\Credentials('65821CECD6304779B7570BA2D06AD953', 'michaeldouglas010790@gmail.com');
    
    $payment
            ->setPaymentCurrency('BRL')
            ->setPaymentReference('REF1')
            ->setPaymentShippingType(1);

    $payment->setPaymentAddress($dados);
    $payment->setAddItem($dados);
    
    echo "<pre>";
    print_r($payment->getPaymentItems());
}  catch (\Exception $e){
    print_r($e);
}