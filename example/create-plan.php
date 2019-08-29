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
use laravel\pagseguro\Facades\Plan;

$plan = [

    'body' => [
        'reference' => 'plano laravel pagseguro',
    ],


    'preApproval' => [
        'name' => 'Plano ouro - mensal',
        'charge' => 'AUTO', // outro valor pode ser MANUAL
        'period' => 'MONTHLY', //WEEKLY, BIMONTHLY, TRIMONTHLY, SEMIANNUALLY, YEARLY
        'amountPerPayment' => '125.00', // obrigatório para o charge AUTO - mais que 1.00, menos que 2000.00
        'membershipFee' => '50.00', //opcional - cobrado com primeira parcela
        'trialPeriodDuration' => 30, //opcional
        'details' => 'Decrição do plano', //opcional
    ]

];

try {
    Config::set('use-sandbox', true);
    $facade = new Plan();
    $credentials = new Credentials($credentialKey, $credentialEmail);
    $plan = $facade->createFromArray($plan);
    $information = $plan->send($credentials);
    printf('<pre>%s</pre>', print_r($information, 1));
    printf('<a href="%s">Clique para pagar</a>', $information->getLink());

} catch (\Exception $e) {
    printf('<pre>%s</pre>', print_r((string)$e, 1));
}
