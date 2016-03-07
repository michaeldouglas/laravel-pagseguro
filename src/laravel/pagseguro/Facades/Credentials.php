<?php

namespace laravel\pagseguro\Facades;

use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials as PagSeguroCredentials;

/**
 * Credentials Facade
 * @author  Isaque de Souza <isaquesb@gmail.com>
 */
class Credentials
{

    /**
     * Get Default Credentials
     * @param string $token
     * @param string $email
     * @return Credentials
     */
    public function create($token, $email)
    {
        return new PagSeguroCredentials($token, $email);
    }

    /**
     * Get Default Credentials
     * @return Credentials
     */
    public function get()
    {
        $data = Config::get('credentials');
        return $this->create($data['token'], $data['email']);
    }
}
