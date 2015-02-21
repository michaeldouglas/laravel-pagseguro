<?php

namespace laravel\pagseguro\Credentials;

/**
 * Credential Class to PagSeguro Operations
 *
 * @category   Credentials
 * @package    Laravel\PagSeguro
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      : 02/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */
class Credentials implements CredentialsInterface
{

    const ERROR_INVALID_TOKEN = 'Invalid credential token';
    const ERROR_INVALID_EMAIL = 'Invalid credential email';

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $token;

    /**
     * Constructor
     * @param string $token PagSeguro Token
     * @param string $email PagSeguro Account E-mail
     * @throws \InvalidArgumentException
     */
    public function __construct($token, $email)
    {
        if(!$this->_tokenIsValid($token)) {
            throw new \InvalidArgumentException (self::ERROR_INVALID_TOKEN);
        }
        if(!$this->_emailIsValid($email)) {
            throw new \InvalidArgumentException (self::ERROR_INVALID_EMAIL);
        }
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Is a Valid Credential
     * @return bool
     */
    public function isValid()
    {
        $validEmail = $this->_emailIsValid($this->email);
        $validToken = $this->_tokenIsValid($this->token);
        return $validEmail && $validToken;
    }

    /**
     * Valid e-mail test
     * @param string $email E-mail address
     * @return bool
     */
    protected function _emailIsValid($email)
    {
        return !is_null($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Valid token syntax test
     * @param string $token Token
     * @return bool
     */
    protected function _tokenIsValid($token)
    {
        return !is_null($token) && is_string($token) && !empty($token);
    }

    /**
     * Get Token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Return Account Email Address
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Return array credential
     * @return string
     */
    public function __toArray()
    {
        return ['email' => $this->email, 'token' => $this->token];
    }
  
}
