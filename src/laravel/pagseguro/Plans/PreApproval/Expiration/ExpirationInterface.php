<?php

namespace laravel\pagseguro\Plans\PreApproval\Expiration;

/**
 * Expiration Interface
 *
 * @category  Expiration
 * @package   laravel\pagseguro\Plans\Sender
 *
 * @author    Thiago Valente <thiagoavalente@gmail.com>
 * @since     2019-12-13
 *
 * @copyright Laravel\PagSeguro
 */
interface ExpirationInterface
{

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = []);

    /**
     * Get Value (Valor)
     * @return int
     */
    public function getValue();

    /**
     * Set Value
     * @param int $value
     * @return ExpirationInterface
     */
    public function setValue($value);

    /**
     * Get Unit (Unidade de tempo)
     * @return string
     */
    public function getUnit();

    /**
     * Set Unit
     * @param int $unit
     * @return ExpirationInterface
     */
    public function setUnit($unit);

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
