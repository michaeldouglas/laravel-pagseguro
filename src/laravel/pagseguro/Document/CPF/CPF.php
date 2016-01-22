<?php

namespace laravel\pagseguro\Document\CPF;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Document\DocumentInterface;

/**
 * CPF Document Object
 *
 * @category   Document
 * @package    Laravel\PagSeguro\Document
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
class CPF implements DocumentInterface
{

    /**
     * Number
     * @var string
     */
    private $number;

    /**
     * Type
     * @var string
     */
    private $type = 'CPF';

    use DataHydratorTrait,
        ValidateTrait {
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
     * Get Number
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get Type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set Number
     * @param string $number
     * @return Cpf
     */
    public function setNumber($number)
    {
        $filterNum = preg_replace('/[^0-9]/', '', $number);
        $padNum = str_pad($filterNum, 11, '0', STR_PAD_LEFT);
        $this->number = $padNum;
        return $this;
    }

    /**
     * Set Type
     * @param string $type
     * @return Cpf
     */
    protected function setType($type)
    {
        if ($type !== 'CPF') { // Restrict to Hydrate
            throw new \InvalidArgumentException('Invalid CPF Type');
        }
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
