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
    
    public function ExceptionError()
    {
        if(count($this->errors)>0) {
            throw new \Exception("Error: ". implode("\n", $this->errors));
        }
    }

    private function xml2array($xmlObject)
    {
        return json_decode(json_encode($xmlObject), TRUE);
    }
}
