<?php

namespace laravel\pagseguro\Phone;

use Illuminate\Validation\Validator;

/**
 * Phone Interface
 *
 * @category   Phone
 * @package    Laravel\PagSeguro\Phone
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
interface PhoneInterface
{

    /**
     * Get Area Code (DDD)
     * @return int
     */
    public function getAreaCode();

    /**
     * Set Area Code (DDD)
     * @param int $areaCode
     * @return PhoneInterface
     */
    public function setAreaCode($areaCode);

    /**
     * Get Country Code (DDI)
     * @return int
     */
    public function getCountryCode();

    /**
     * Set Country Code (DDI)
     * @param int $countryCode
     * @return PhoneInterface
     */
    public function setCountryCode($countryCode);

    /**
     * Get Number
     * @return string
     */
    public function getNumber();

    /**
     * Set Number
     * @param string $number
     * @return PhoneInterface
     */
    public function setNumber($number);

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
     * @return null|\Illuminate\Validation\Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
