<?php

require '_prevent-access.php';
require_once __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);

/**
 * Change Credentials to your SandBox
 */
$sandBoxCredentials = include '_sandbox-credentials.php';
$credentialEmail = $sandBoxCredentials['email']; // Email
$credentialKey = $sandBoxCredentials['key']; // Public Key
$senderEmail = 'comprador-de-testes@sandbox.pagseguro.com.br'; // Sender-Email

use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Checkout\Facade\CheckoutFacade;

$data = [
    'items' => [
        [
            'id' => 18,
            'description' => 'Laravel PS Simple Checkout',
            'quantity' => 1,
            'shippingCost' => 3.5,
            'width' => 50,
            'weight' => 45,
            'height' => 45,
            'length' => 60,
            'amount' => 1.15,
        ]
    ],
    'shipping' => [
        'address' => [
            'postalCode' => '06410030',
            'street' => 'Rua da Selva',
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
        'email' => $senderEmail,
        'name' => 'Isaque de Souza Barbosa',
        'documents' => [
            [
                'number' => '80808080822',
                'type' => 'CPF'
            ]
        ],
        'phone' => '11985445522',
        'bornDate' => '1988-03-25',
    ]
];

try {
    Config::set('use-sandbox', true);
    $facade = new CheckoutFacade();
    $credentials = new Credentials($credentialKey, $credentialEmail);
    $checkout = $facade->createFromArray($data);
    $information = $checkout->send($credentials);
    printf('<pre>%s</pre>', print_r($information, 1));
    printf('<a href="%s">Clique para pagar</a>', $information->getLink());
} catch (\Exception $e) {
    printf('<pre>%s</pre>', print_r((string)$e, 1));
}
