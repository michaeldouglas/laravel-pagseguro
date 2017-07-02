<?php

namespace laravel\pagseguro\Document;

use laravel\pagseguro\Document\CPF\CPF;

/**
 * Document Interface
 *
 * @category   Document
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
interface DocumentInterface
{

    /**
     * Get Number
     * @return string
     */
    public function getNumber();

    /**
     * Get Type
     * @return string
     */
    public function getType();

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
     * @return null|\Illuminate\Validation\Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
