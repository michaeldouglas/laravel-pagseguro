<?php

namespace laravel\pagseguro\Address;

/**
 * Address Interface
 *
 * @category   Address
 * @package    Laravel\PagSeguro\Address
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-08-01
 *
 * @copyright  Laravel\PagSeguro
 */
interface AddressInterface
{

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = []);

    /**
     * Get Postal Code
     * @return string
     */
    public function getPostalCode();

    /**
     * Get Street
     * @return string
     */
    public function getStreet();

    /**
     * Get Number
     * @return string
     */
    public function getNumber();

    /**
     * Get Complement
     * @return string
     */
    public function getComplement();

    /**
     * Get Neighborhood
     * @return string
     */
    public function getNeighborhood();

    /**
     * Get City
     * @return string
     */
    public function getCity();

    /**
     * Get State
     * @return string
     */
    public function getState();

    /**
     * Get Country
     * @return string
     */
    public function getCountry();

    /**
     * Set PostalCode
     * @param string $postalCode
     * @return string
     */
    public function setPostalCode($postalCode);

    /**
     * Set Street
     * @param string $street
     * @return string
     */
    public function setStreet($street);

    /**
     * Set Number
     * @param string $number
     * @return string
     */
    public function setNumber($number);

    /**
     * Set Complement
     * @param string $complement
     * @return string
     */
    public function setComplement($complement);

    /**
     * Set Neighborhood
     * @param string $neighborhood
     * @return string
     */
    public function setNeighborhood($neighborhood);

    /**
     * Set City
     * @param string $city
     * @return string
     */
    public function setCity($city);

    /**
     * Set State
     * @param string $state
     * @return string
     */
    public function setState($state);

    /**
     * Set Country
     * @param string $country
     * @return string
     */
    public function setCountry($country);

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = []);

    /**
     * Test Valid Data
     * @return bool
     */
    public function isValid();

    /**
     * Get Validator
     * Return only after hydrate
     * @return null|Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();

}
