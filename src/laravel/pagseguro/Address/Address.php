<?php

/**
 * Classe responsável pela criação do objeto de endereço
 *
 * @category   Address
 * @package    Laravel\PagSeguro\Address
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 01/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Address;

use laravel\pagseguro\Helper\Helper;

class Address
{

    private $postalCode;
    private $street;
    private $number;
    private $complement;
    private $district;
    private $city;
    private $state;
    private $country;

    /**
     * Irá verificar o array de item e setar as propriedades do item
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return void
     */
    public function __construct($item = null)
    {
        if (!is_null($item) && is_array($item)) {
            switch ($item) {
                case isset($item['cep']):
                    $this->postalCode = Helper::setVerifyKeyItem($item, 'cep');
        
                case isset($item['rua']):
                    $this->street = Helper::setVerifyKeyItem($item, 'rua');
        
                case isset($item['numero']):
                    $this->number = Helper::setVerifyKeyItem($item, 'numero');
        
                case isset($item['complemento']):
                    $this->complement = Helper::setVerifyKeyItem($item, 'complemento');
                    
                case isset($item['bairro']):
                    $this->district = Helper::setVerifyKeyItem($item, 'bairro');
        
                case isset($item['cidade']):
                    $this->city = Helper::setVerifyKeyItem($item, 'cidade');

                case isset($item['estado']):
                    $this->state = Helper::setVerifyKeyItem($item, 'estado');
        
                case isset($item['pais']):
                    $this->country = Helper::setVerifyKeyItem($item, 'pais');
                    break;
                default:
                    throw new \Exception('Nenhum parametro encontrado!');
            }
        }
    }
      
    public function getItemPostalCode()
    {
        return $this->postalCode;
    }

    public function getItemStreet()
    {
        return $this->street;
    }
    
    public function getItemNumber()
    {
        return $this->number;
    }
    
    public function getItemComplement()
    {
        return $this->complement;
    }
    
    public function getItemDistrict()
    {
        return $this->district;
    }
    
    public function getItemCity()
    {
        return $this->city;
    }
    
    public function getItemState()
    {
        return $this->state;
    }
    
    public function getItemCountry()
    {
        return $this->country;
    }

}
