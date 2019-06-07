<?php

$credentials = [
    'email' => 'paezraphael@gmail.com',
    'key' => 'B2019BCE2FF64CE1BFBBFDC04B747CD2'
];

if (empty($credentials['email']) || empty($credentials['key'])) {
    die('Informe as credenciais da SANDBOX em :' . basename(__FILE__));
}

return $credentials;