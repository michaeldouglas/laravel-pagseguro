<?php

require '_prevent-access.php';
require_once __DIR__ . '/../vendor/autoload.php';

use laravel\pagseguro\Http\Request\Adapter\CurlAdapter;
use laravel\pagseguro\Http\Request\Request;

$adapter = new CurlAdapter([
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0
]);
$request = new Request($adapter);
$response = $request->get('https://ws.sandbox.pagseguro.uol.com.br/');
if (!$response) {
    echo 'Fail';
} else {
    echo $response->getRawBody();//OK
}
