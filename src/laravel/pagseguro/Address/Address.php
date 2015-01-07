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
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return void
     */
    public function __construct($item = null)
    {
        if (!is_null($item) && is_array($item)) {
            switch ($item) {
                case isset($item['cep']):
                    $this->postalCode = Helper::getValueOrDefault($item, 'cep');

                case isset($item['rua']):
                    $this->street = Helper::getValueOrDefault($item, 'rua');

                case isset($item['numero']):
                    $this->number = Helper::getValueOrDefault($item, 'numero');

                case isset($item['complemento']):
                    $this->complement = Helper::getValueOrDefault($item, 'complemento');

                case isset($item['bairro']):
                    $this->district = Helper::getValueOrDefault($item, 'bairro');

                case isset($item['cidade']):
                    $this->city = Helper::getValueOrDefault($item, 'cidade');

                case isset($item['estado']):
                    $this->state = Helper::getValueOrDefault($item, 'estado');

                case isset($item['pais']):
                    $this->country = Helper::getValueOrDefault($item, 'pais');
                    break;
                default:
                    throw new \Exception('Nenhum parametro encontrado!');
            }
        }
    }
    
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getComplement()
    {
        return $this->complement;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function setComplement($complement)
    {
        $this->complement = $complement;
        return $this;
    }

    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

}
