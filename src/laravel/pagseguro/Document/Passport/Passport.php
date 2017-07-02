<?php

namespace laravel\pagseguro\Document\Passport;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Document\DocumentInterface;

/**
 * Passport Document Object
 *
 * @category   Document
 * @package    Laravel\PagSeguro\Document
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
class Passport implements DocumentInterface
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
    private $type = 'PASSPORT';

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
     * @return Passport
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Set Type
     * @param string $type
     * @return Passport
     */
    protected function setType($type)
    {
        if ($type !== 'PASSPORT') { // Restrict to Hydrate
            throw new \InvalidArgumentException('Invalid Passport Type');
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
