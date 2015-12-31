<?php

namespace laravel\pagseguro\Address;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Address Object
 *
 * @category   Address
 * @package    Laravel\PagSeguro\Address
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>, Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2015-01-08
 *
 * @copyright  Laravel\PagSeguro
 */
class Address implements AddressInterface
{

    /**
     * Postal Code (CEP)
     * @var string
     */
    protected $postalCode;

    /**
     * Street (Rua)
     * @var string
     */
    protected $street;

    /**
     * Number (Número)
     * @var string
     */
    protected $number;

    /**
     * Complement (Complemento)
     * @var string
     */
    protected $complement;

    /**
     * District (Bairro)
     * @var string
     */
    protected $district;

    /**
     * City (Cidade)
     * @var string
     */
    protected $city;

    /**
     * State (Estado)
     * @var string
     */
    protected $state;

    /**
     * Country
     * @var string
     */
    protected $country;

    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Get Postal Code (CEP)
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Get Street (Rua)
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get Number (Número)
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get Complement (Complemento)
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Get District (Bairro)
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Get City (Cidade)
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get State (Estado)
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get Country (País)
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set Postal Code (CEP)
     * @param string $postalCode
     * @return string
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Set Street (Rua)
     * @param string $street
     * @return string
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Set Number (Número)
     * @param string $number
     * @return string
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Set Complement (Complemento)
     * @param string $complement
     * @return string
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * Set District (Bairro)
     * @param string $district
     * @return string
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * Set City (Cidade)
     * @param string $city
     * @return string
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Set State (Estado)
     * @param string $state
     * @return string
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Set Country (País)
     * @param string $country
     * @return string
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}
