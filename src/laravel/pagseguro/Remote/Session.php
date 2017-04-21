<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Parser\Xml;

/**
 * Remote Session
 *
 * @category   Remote
 * @package    Laravel\PagSeguro\Remote
 *
 * @author     Eduardo Alves Pereira <eduardoalves.info@gmail.com>
 *
 * @copyright  Laravel\PagSeguro
 */
class Session extends ConsumerAbstract
{

    /**
     * Get Session Id
     * @param CredentialsInterface $credential
     * @return array|boolean Array with session info or FALSE on failure
     */
    public function getSession(CredentialsInterface $credential)
    {
        $url = $this->getUrlTo('sessions');
        $completeUrl = "{$url}";
        $request = $this->getRequest();
        $credentialData = $this->getCredentialData($credential);
        $response = $request->post($completeUrl, $credentialData);
        if (!$response) {
            throw new \RuntimeException('Create session failure');
        }
        $body = $response->getRawBody();
        if ($response->getHttpStatus() !== 200) {
            $error = 'Error on getSession: ' . $response->getHttpStatus() . '-' . $body;
            throw new \RuntimeException($error);
        }
        $parser = new Xml($body);
        return $parser->toArray();
    }
}
