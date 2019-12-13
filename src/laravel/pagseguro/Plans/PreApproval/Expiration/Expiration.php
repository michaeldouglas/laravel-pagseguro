<?php

namespace laravel\pagseguro\Plans\PreApproval\Expiration;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Sender Object
 *
 * @category   Sender
 * @package   laravel\pagseguro\Plans\Sender
 *
 * @author     Michael Araujo <michaeldouglas010790@gmail.com>
 * @since      2019-08-28
 *
 * @copyright  Laravel\PagSeguro
 */
class Expiration implements ExpirationInterface
{
    /**
     * Value (Valor do tempo)
     * @var int
     */
    protected $value;

    /**
     * Unit (Unidade de tempo dia, mês ou ano)
     */
    protected $unit;

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
     * Get Name (Nome)
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $name
     * @return $this|PreApprovalInterface
     */
    public function setValue($value)
    {
        $this->value= $value;

        return $this;
    }

    public function getUnit()
    {
        return  $this->unit;
    }

    public function setUnit($unit)
    {
        $this->charge = $unit;

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
