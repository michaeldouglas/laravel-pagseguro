<?php

$credentials = [
    'email' => '',
    'key' => ''
];

if (empty($credentials['email']) || empty($credentials['key'])) {
    die('Informe as credenciais da SANDBOX em :' . basename(__FILE__));
}

return $credentials;