<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \laravel\pagseguro\Address\Address;

$addressData = [
    'postalCode' => '06410000',
    'street' => 'Rua da prata',
    'number' => '55',
    'complement' => '',
    'neighborhood' => 'Jardim dos Camargos',
    'city' => 'Barueri',
    'state' => 'SP',
    'country' => 'Brasil',
];
$address = new Address($addressData);


echo sprintf('DATA: %s',implode(', ', $address->toArray()));
