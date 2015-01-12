<?php

namespace laravel\pagseguro\Sender\Document\CPF;

use laravel\pagseguro\Complements\DataHydratorTrait,
    laravel\pagseguro\Sender\Document\DocumentInterface;

/**
 * CPF Document Object
 *
 * @category   SenderDocument
 * @package    Laravel\PagSeguro\Sender\Document\Cpf
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

    use DataHydratorTrait;

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if(count($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Data Hydrate
     * @param array $data
     * @return CPF
     */
    public function hydrate(array $data = array())
    {
        if(array_key_exists('type', $data)) {
            unset($data['type']);
        }
        parent::hydrate($data);
        return $this;
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
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }

}