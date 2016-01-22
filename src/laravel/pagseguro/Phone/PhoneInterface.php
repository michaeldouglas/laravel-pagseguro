<?php

namespace laravel\pagseguro\Phone;

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
    public function getAreacode();

    /**
     * Set Area Code (DDD)
     * @param int $areacode
     * @return PhoneInterface
     */
    public function setAreacode($areacode);

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
     * @return null|Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
