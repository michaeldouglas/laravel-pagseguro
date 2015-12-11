<?php

namespace laravel\pagseguro\Credentials;

/**
 * Credential Interface to PagSeguro Operations
 *
 * @category   Credentials
 * @package    Laravel\PagSeguro
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      : 02/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */
interface CredentialsInterface
{

    /**
     * Constructor
     * @param string $token PagSeguro Token
     * @param string $email PagSeguro Account E-mail
     * @throws \InvalidArgumentException
     */
    public function __construct($token, $email);

    /**
     * Is a Valid Credential
     * @return bool
     */
    public function isValid();

    /**
     * Get Token
     * @return string
     */
    public function getToken();

    /**
     * Return Account Email Address
     * @return string
     */
    public function getEmail();
}
