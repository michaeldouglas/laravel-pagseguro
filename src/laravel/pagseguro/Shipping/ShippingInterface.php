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

    const TYPE_PAC = 1;
    const TYPE_SEDEX = 2;
    const TYPE_UNKNOW = 3;

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
     * @return float
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
     * @return ShippingInterface
     */
    public function setAddress(AddressInterface $address);

    /**
     * Set Cost
     * @param float $cost
     * @return ShippingInterface
     */
    public function setCost($cost);

    /**
     * Set Type
     * @param int $type
     * @return ShippingInterface
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
     * @return null|\Illuminate\Validation\Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
