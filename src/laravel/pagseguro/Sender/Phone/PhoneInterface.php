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
    public function getSenderAreaCode();

    /**
     * Set Area Code (DDD)
     * @param int $senderAreaCode
     * @return Phone
     */
    public function setSenderAreaCode($senderAreaCode);

    /**
     * Get Number
     * @return string
     */
    public function getSenderPhone();

    /**
     * Set Number
     * @param string $senderPhone
     * @return Cpf
     */
    public function setSenderPhone($senderPhone);

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