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
$senderEmail = 'viajante@sandbox.pagseguro.com.br'; // Sender-Email

use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Checkout\Facade\CheckoutFacade;

$data = [
    'items' => [
        [
            'id' => 20,
            'description' => 'Passagem para BAHIA',
            'quantity' => 2,
            'amount' => 15.6
        ]
    ],
    'sender' => [
        'email' => $senderEmail,
        'name' => 'Isaque de Souza Barbosa',
        'documents' => [
            [
                'number' => '40404040411',
                'type' => 'CPF'
            ]
        ],
        'phone' => '11985445522',
        'bornDate' => '1988-03-21',
    ],
    'currency' => 'BRL',
    'travel' => [
        'passengers' => [
            [
                'name' => 'Isaque de Souza',
                'cpf' => '40404040411',
                'passport' => '4564897987'
            ],
            [
                'name' => 'Vivian Pereira',
                'cpf' => '80808080822',
            ]
        ],
        'origin' => [
            'city' => 'SAO PAULO - SP',
            'airportCode' => 'CGH', //https://pt.wikipedia.org/wiki/C%C3%B3digos_IATA_de_aeroportos_brasileiros
        ],
        'destination' => [
            'city' => 'SALVADOR - BA',
            'airportCode' => 'SSA',
        ]
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
