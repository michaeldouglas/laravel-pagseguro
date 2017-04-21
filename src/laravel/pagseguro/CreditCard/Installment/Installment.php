<?php

namespace laravel\pagseguro\CreditCard\Installment;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Installment Object
 *
 * @category   Installment
 * @package    Laravel\PagSeguro\CreditCard\Installment
 *
 * @author     Eduardo Alves <eduardoalves.info@gmail.com>
 * @since      2016-04-21
 *
 * @copyright  Laravel\PagSeguro
 */
class Installment implements InstallmentInterface
{

    /**
     * Quantity
     * @var int
     */
    protected $quantity;

    /**
     * Value
     * @var int
     */
    protected $value;

    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Get Installment Instance
     * @param InstallmentInterface|array $installment
     * @return InstallmentInterface
     */
    public static function factory($installment)
    {
        if ($installment instanceof InstallementInterface) {
            return new self($installment);
        }
        elseif (is_array($installment)
            && array_key_exists('quantity', $installment)
            && array_key_exists('value', $installment)
        ) {
            return new self($installment);
        }
        else {
            throw new \InvalidArgumentException('Invalid Installment Data');
        }
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
     * Get Quantity
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set Quantity
     * @param int $quantity
     * @return Installment
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get Value
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Value
     * @param int $value
     * @return Installment
     */
    public function setValue($value)
    {
        $this->value = $value;
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