<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Credentials\CredentialsInterface;

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
class Transaction
{

    /**
     * 
     * @param CredentialsInterface $credential
     * @param string $code
     * @return array|boolean Array with transaction info or FALSE on failure
     */
    public function getStatus(CredentialsInterface $credential, $code)
    {
        
    }
}
