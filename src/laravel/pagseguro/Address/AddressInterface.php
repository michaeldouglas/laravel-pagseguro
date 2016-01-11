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
     * Get Postal Code (CEP)
     * @return string
     */
    public function getPostalCode();

    /**
     * Get Street (Rua)
     * @return string
     */
    public function getStreet();

    /**
     * Get Number (Número)
     * @return string
     */
    public function getNumber();

    /**
     * Get Complement (Complemento)
     * @return string
     */
    public function getComplement();

    /**
     * Get District (Bairro)
     * @return string
     */
    public function getDistrict();

    /**
     * Get City (Cidade)
     * @return string
     */
    public function getCity();

    /**
     * Get State (Estado)
     * @return string
     */
    public function getState();

    /**
     * Get Country (País)
     * @return string
     */
    public function getCountry();

    /**
     * Set Postal Code (CEP)
     * @param string $postalCode
     * @return string
     */
    public function setPostalCode($postalCode);

    /**
     * Set Street (Rua)
     * @param string $street
     * @return string
     */
    public function setStreet($street);

    /**
     * Set Number (Número)
     * @param string $number
     * @return string
     */
    public function setNumber($number);

    /**
     * Set Complement (Complemento)
     * @param string $complement
     * @return string
     */
    public function setComplement($complement);

    /**
     * Set District (Bairro)
     * @param string $district
     * @return string
     */
    public function setDistrict($district);

    /**
     * Set City (Cidade)
     * @param string $city
     * @return string
     */
    public function setCity($city);

    /**
     * Set State (Estado)
     * @param string $state
     * @return string
     */
    public function setState($state);

    /**
     * Set Country (País)
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
}
