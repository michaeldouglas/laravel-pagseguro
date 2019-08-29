<?php

$credentials = [
    'email' => 'michaeldouglas010790@gmail.com',
    'key' => '80745009AAC04FCB80D8B73CAA87B9B8'
];

if (empty($credentials['email']) || empty($credentials['key'])) {
    die('Informe as credenciais da SANDBOX em :' . basename(__FILE__));
}

return $credentials;