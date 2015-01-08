<?php

namespace laravel\pagseguro\Address;

use \laravel\pagseguro\Complements\DataHydratorTrait;

/**
 * Address Object
 *
 * @category   Address
 * @package    Laravel\PagSeguro\Address
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>, Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2015-08-01
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
     * Neighborhood (Bairro)
     * @var string
     */
    protected $neighborhood;

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

    /**
     * @var array
     */
    protected $validationRules = [
        'postalCode' => 'Required|digits:8',
        'street' => 'Required|max:255',
        'number' => 'Required|max:50',
        'complement' => 'max:255',
        'neighborhood' => 'Required|max:255',
        'city' => 'Required|max:255',
        'state' => 'Required|max:2',
        'country' => 'Required|max:50',
    ];

    use DataHydratorTrait;

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if(count($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Get Postal Code
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Get Street
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get Number
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get Complement
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Get Neighborhood
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Get City
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get State
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get Country
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set PostalCode
     * @param string $postalCode
     * @return string
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Set Neighborhood
     * @param string $street
     * @return string
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Set Neighborhood
     * @param string $number
     * @return string
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Set Neighborhood
     * @param string $complement
     * @return string
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * Set Neighborhood
     * @param string $neighborhood
     * @return string
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;
        return $this;
    }

    /**
     * Set Neighborhood
     * @param string $city
     * @return string
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Set Neighborhood
     * @param string $state
     * @return string
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Set Neighborhood
     * @param string $country
     * @return string
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

}
