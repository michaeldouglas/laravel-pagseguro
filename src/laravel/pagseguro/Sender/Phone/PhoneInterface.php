<?php

namespace laravel\pagseguro\Sender\Phone;

use laravel\pagseguro\Complements\DataHydratorTrait;

/**
 * Phone Interface
 *
 * @category   SenderPhone
 * @package    Laravel\PagSeguro\Sender\Phone
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
     * @return Phone
     */
    public function setAreaCode($areaCode);

    /**
     * Get Number
     * @return string
     */
    public function getNumber();

    /**
     * Set Number
     * @param string $number
     * @return Cpf
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