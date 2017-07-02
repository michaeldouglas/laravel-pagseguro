<?php

namespace laravel\pagseguro\Transaction;

use laravel\pagseguro\Credentials\CredentialsInterface as Credentials;
use laravel\pagseguro\Remote\Transaction as RemoteTransaction;

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
     * @var Credentials
     */
    protected $credentials;

    /**
     * Transaction Code
     * @var string
     */
    protected $code;

    /**
     * Transaction Information
     * @var Information\Information
     */
    protected $information;

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
        $this->credentials = $credentials;
        $this->setCode($code);
        if ($check && !$this->check()) {
            throw new \RuntimeException('Check fail on auto-check');
        }
    }

    /**
     * Get Code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Transaction Code
     * @param string $code
     * @throws \InvalidArgumentException
     */
    protected function setCode($code)
    {
        if (!\is_string($code)) {
            throw new \InvalidArgumentException('Invalid transaction code');
        }
        $this->code = $code;
    }

    /**
     * Check transaction status
     * @return bool
     */
    public function check()
    {
        $remote = new RemoteTransaction();
        $data = $remote->getStatus($this->getCode(), $this->credentials);
        $factory = new Information\InformationFactory($data);
        $this->information = $factory->getInformation();
        return !is_null($this->information);
    }

    /**
     * Get Transaction Info
     * @return Information\Information
     * @throws \RuntimeException
     */
    public function getInformation()
    {
        if (is_null($this->information) && !$this->check()) {
            throw new \RuntimeException('Check fail');
        }
        return $this->information;
    }
}
