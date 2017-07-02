<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Parser\Xml;

/**
 * Remote Transaction Information
 *
 * @category   Remote
 * @package    Laravel\PagSeguro\Remote
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Notification extends ConsumerAbstract
{

    /**
     * Get Transaction Status
     * @param string $code
     * @param CredentialsInterface $credential
     * @return array|boolean Array with transaction info or FALSE on failure
     */
    public function transaction($code, CredentialsInterface $credential)
    {
        $url = $this->getUrlTo('transactions-notifications');
        $completeUrl = "{$url}/{$code}";
        $request = $this->getRequest();
        $credentialData = $this->getCredentialData($credential);
        $response = $request->get($completeUrl, $credentialData);
        if (!$response) {
            throw new \RuntimeException('Notification check failure');
        }
        $body = $response->getRawBody();
        if ($response->getHttpStatus() !== 200) {
            $error = 'Error on getStatus: ' . $response->getHttpStatus() . '-' . strip_tags($body);
            throw new \RuntimeException($error);
        }
        $parser = new Xml($body);
        return $parser->toArray();
    }
}
