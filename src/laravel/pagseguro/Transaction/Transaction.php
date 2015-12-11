<?php

namespace laravel\pagseguro\Transaction;

use laravel\pagseguro\Credentials\CredentialsInterface as Credentials;

/**
 * Transaction Object
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-09-15
 *
 * @copyright  Laravel\PagSeguro
 */
class Transaction implements TransactionInterface
{

    /**
     * Credentials
     * @var CredentialsInterface
     */
    protected $credentials;

    /**
     * Transaction Code
     * @var string
     */
    protected $code;

    /**
     * Constructor
     * @param string $code Transaction code
     * @param Credentials $credentials
     * @param boolean $check Auto Check on Remote
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function __construct($code, Credentials $credentials, $check = true)
    {
        if (!$credentials || !$credentials->isValid()) {
            throw new \InvalidArgumentException('Invalid credentials');
        }
        $this->credentials = $credentials;
        $this->setCode($code);
        if ($check && !$this->check()) {
            throw new \RuntimeException('Check fail on auto-check');
        }
    }

    /**
     * Transaction Code
     * @param string $code
     * @throws \InvalidArgumentException
     */
    protected function setCode($code)
    {
        if (!\is_string($code) || \strlen($code) != 36) {
            throw new \InvalidArgumentException('Invalid transaction code');
        }
        $this->code = $code;
    }

    /**
     * Check transaction status
     */
    public function check()
    {
        
    }
}
