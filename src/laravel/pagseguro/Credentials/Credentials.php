<?php

/**
 * Classe responsável pela criação do objeto de credencial da requisição de pagamento
 *
 * @category   Credentials
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 02/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Credentials;

class Credentials{
    private $email;
    private $token;
    
    public function __construct($token = null, $email = null)
    {
        $this->token = $token;
        $this->email = $email;   
        $this->setValidateCredentials();
    }
    
    private function setValidateCredentials(){
        if( ((!is_null($this->token) && is_string($this->token)) && (filter_var($this->email, FILTER_VALIDATE_EMAIL) && !is_null($this->email))) === FALSE ){ 
            throw new \Exception('Dados de credencial inválidos!');
        }
    }
    
    public function getToken(){
        return $this->token;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
}