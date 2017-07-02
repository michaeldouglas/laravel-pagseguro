<?php

namespace laravel\pagseguro\Shipping;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Address\AddressInterface;

/**
 * Shipping Object
 *
 * @category   Shipping
 * @package    Laravel\PagSeguro\Shipping
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Shipping implements ShippingInterface
{
    
    /**
     * Address
     * @var AddressInterface
     */
    protected $address;

    /**
     * Cost
     * @var string
     */
    protected $cost;

    /**
     * Type
     * @var string
     */
    protected $type;

    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Get Address
     * @return AddressInterface
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get Cost
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Get Type
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set Address
     * @param AddressInterface $address
     * @return ShippingInterface
     */
    public function setAddress(AddressInterface $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Set Cost
     * @param float $cost
     * @return ShippingInterface
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * Set Type
     * @param int $type
     * @return ShippingInterface
     */
    public function setType($type)
    {
        $alloweds = [self::TYPE_PAC, self::TYPE_SEDEX, self::TYPE_UNKNOW];
        if (!in_array($type, $alloweds)) {
            throw new \InvalidArgumentException('Invalid shipping type');
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}
