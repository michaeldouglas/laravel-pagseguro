<?php

/**
 * Classe responsável pela tratativa de erros
 *
 * @category   request
 * @package    Laravel\PagSeguro\Error
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 09/01/2016
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Error;

class LaravelError
{
    protected $errors = [];
    protected $xmlObject;
    
    public function __construct(\SimpleXMLElement $xmlObject) {
        $this->xmlObject = $xmlObject;
    }
    
    /**
     * Método responsável por verificar a requisição se existe o chave de error
     * @copyright (c) 2016, Michael Araujo
     * @access public
     * @since 0.1
     */
    public function verifyErrors()
    {
        $array = $this->xml2array($this->xmlObject);
        if(array_key_exists('error', $array)) {
            foreach ($array as $error) {
                $this->errors[$error['code']] = $error['message'];
            }
        }
        
        return $this;
    }
    
    /**
     * Método responsável por setar a string contendo os erros
     * @copyright (c) 2016, Michael Araujo
     * @access public
     * @since 0.1
     */
    public function ExceptionError()
    {
        if(count($this->errors)>0) {
            throw new \Exception("Error: ". implode("\n", $this->errors));
        }
    }
    
    /**
     * Método responsável por transformar o objeto XML em Array
     * @copyright (c) 2016, Michael Araujo
     * @access private
     * @since 0.1
     * @param object contendo o xml da requisição
     */
    private function xml2array($xmlObject)
    {
        return json_decode(json_encode($xmlObject), TRUE);
    }
        
    /**
     * Método responsável por verificar as permissões do usuário
     * @copyright (c) 2016, Michael Araujo
     * @access public
     * @since 0.1
     */
    public function verifyUser()
    {
        if($this->xmlObject == "Unauthorized") {
            throw new \Exception("Error: Usuário PagSeguro inválido, por favor, leia: https://pagseguro.uol.com.br/preferencias/integracoes.jhtml");
        }
    }
}
