<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Http\Request\Request;

/**
 * Remote Consumer
 *
 * @category   Remote
 * @package    Laravel\PagSeguro\Remote
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
abstract class ConsumerAbstract
{

    /**
     * Request Object
     * @var Request
     */
    protected $request;

    /**
     * Return Request Object
     * @return Request
     */
    protected function getRequest()
    {
        $adapter = Manager::getHttpAdapter();
        $request = new Request($adapter);
        return $request;
    }

    /**
     * Get Credential Data to Request
     * @param CredentialsInterface $credential
     * @return array Credential Data
     */
    protected function getCredentialData(CredentialsInterface $credential)
    {
        return [
            'email' => $credential->getEmail(),
            'token' => $credential->getToken()
        ];
    }

    /**
     * Return URL from Config
     * @param string $code URL Code
     * @return string
     */
    protected function getUrlTo($code)
    {
        $resolver = new Url\Resolver();
        return $resolver->getByKey($code);
    }
}
