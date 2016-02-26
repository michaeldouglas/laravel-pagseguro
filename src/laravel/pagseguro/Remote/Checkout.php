<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Checkout\CheckoutInterface;
use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Checkout\Statement\Xml\Xml as XmlStatement;
use laravel\pagseguro\Parser\Xml;
use laravel\pagseguro\Http\Request\RequestInterface;

/**
 * Remote Checkout
 *
 * @category   Remote
 * @package    Laravel\PagSeguro\Remote
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Checkout extends ConsumerAbstract
{

    /**
     * Send Checkout
     * @param CheckoutInterface $checkout
     * @param CredentialsInterface $credential
     * @return array|boolean Array with transaction info or FALSE on failure
     */
    public function send(CheckoutInterface $checkout, CredentialsInterface $credential)
    {
        $url = $this->getUrlTo('checkout');
        $request = $this->getRequest();
        $this->prepareStatement($checkout, $request);
        $credentialData = $this->getCredentialData($credential);
        $response = $request->post($url, $credentialData);
        if (!$response) {
            throw new \RuntimeException('Checkout send failure');
        }
        $body = $response->getRawBody();
        if ($response->getHttpStatus() !== 200) {
            $error = 'Error on send: ' . $response->getHttpStatus() . '-' . $body;
            throw new \RuntimeException($error);
        }
        $parser = new Xml($body);
        $data = $parser->toArray();
        if (array_key_exists('code', $data)) {
            $paymentUrl = str_replace('ws.', '', $url) . '/payment.html?code=';
            $data['link'] =  $paymentUrl . $data['code'];
        }
        return $data;
    }

    /**
     * Prepare Request With Statement
     * @param CheckoutInterface $checkout
     * @param RequestInterface $request
     */
    protected function prepareStatement(CheckoutInterface $checkout, RequestInterface $request)
    {
        $stmt = new XmlStatement($checkout);
        $stmt->prepare($request);
    }
}
