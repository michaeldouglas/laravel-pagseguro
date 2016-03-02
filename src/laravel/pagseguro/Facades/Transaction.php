<?php

namespace laravel\pagseguro\Facades;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Transaction\Transaction as PagSeguroTransaction;

/**
 * Transaction Facade
 * @author  Isaque de Souza <isaquesb@gmail.com>
 */
class Transaction
{

    /**
     * @param string $code
     * @param CredentialsInterface $credentials
     * @param bool $autoCheck
     * @return PagSeguroTransaction
     */
    public function get($code, CredentialsInterface $credentials, $autoCheck = true)
    {
        $transaction = new PagSeguroTransaction($code, $credentials, $autoCheck);
        return $transaction;
    }
}
