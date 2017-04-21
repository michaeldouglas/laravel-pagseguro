<?php

namespace laravel\pagseguro\Facades;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Session\Session as PagSeguroSession;

/**
 * Session Facade
 * @author  Eduardo Alves <eduardoalves.info@gmail.com>
 */
class Session
{

    /**
     * @param CredentialsInterface $credentials
     * @return PagSeguroSession
     */
    public function get(CredentialsInterface $credentials)
    {
        $session = new PagSeguroSession($credentials);
        return $session;
    }
}
