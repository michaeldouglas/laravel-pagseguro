<?php

namespace laravel\pagseguro\Session;

use laravel\pagseguro\Credentials\CredentialsInterface as Credentials;
use laravel\pagseguro\Remote\Session as RemoteSession;

/**
 * Transaction Object
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Session
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-09-15
 *
 * @copyright  Laravel\PagSeguro
 */
class Session implements SessionInterface
{

    /**
     * Credentials
     * @var Credentials
     */
    protected $credentials;

    /**
     * Constructor
     * @param Credentials $credentials
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Check transaction status
     * @return bool
     */
    public function getSession()
    {
        $remote = new RemoteSession();
        return $remote->getSession($this->credentials);
    }

}
