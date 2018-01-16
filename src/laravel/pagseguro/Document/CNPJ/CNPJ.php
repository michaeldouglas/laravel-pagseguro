<?php

namespace laravel\pagseguro\Document\CNPJ;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Document\DocumentInterface;

/**
 * CNPJ Document Object
 *
 * @category   Document
 * @package    Laravel\PagSeguro\Document
 *
 * @author     José Tobias de Freitas Neto <jtfnetoo@gmail.com>
 * @since      2018-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class CNPJ implements DocumentInterface
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
    private $type = 'CNPJ';

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
     * @return Cnpj
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
     * @return Cnpj
     */
    protected function setType($type)
    {
        if ($type !== 'CNPJ') { // Restrict to Hydrate
            throw new \InvalidArgumentException('Invalid CNPJ Type');
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
