<?php

namespace laravel\pagseguro\Shipping;

use laravel\pagseguro\Address\AddressInterface;

/**
 * Shipping Interface
 *
 * @category   Sender
 * @package    Laravel\PagSeguro\Shipping
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
interface ShippingInterface
{

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = []);

    
    /**
     * Get Address
     * @return AddressInterface
     */
    public function getAddress();

    /**
     * Get Cost
     * @return cost
     */
    public function getCost();

    /**
     * Get Type
     * @return int
     */
    public function getType();

    /**
     * Set Address
     * @param AddressInterface $address
     * @return \laravel\pagseguro\Sender\Shipping
     */
    public function setAddress(AddressInterface $address);

    /**
     * Set Cost
     * @param float $cost
     * @return \laravel\pagseguro\Sender\Shipping
     */
    public function setCost($cost);

    /**
     * Set Type
     * @param int $type
     * @return \laravel\pagseguro\Sender\Shipping
     */
    public function setType($type);

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
