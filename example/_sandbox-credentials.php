<?php

$credentials = [
    'email' => 'isaquesb@gmail.com',
    'key' => 'C5811506475541DDA9286485A670F90B'
];

if (empty($credentials['email']) || empty($credentials['key'])) {
    die('Informe as credenciais da SANDBOX em :' . basename(__FILE__));
}

return $credentials;