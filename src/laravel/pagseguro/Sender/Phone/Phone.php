<?php

namespace laravel\pagseguro\Sender\Phone;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Phone Object
 *
 * @category   SenderPhone
 * @package    Laravel\PagSeguro\Sender\Phone
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
class Phone implements PhoneInterface
{

    /**
     * Area Code
     * @var string
     */
    protected $areacode;

    /**
     * Number
     * @var string
     */
    protected $number;
    
    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Get Phone Instance
     * @param PhoneInterface|array $phone
     * @return PhoneInterface
     */
    public static function factory($phone)
    {
        if ($phone instanceof PhoneInterface) {
            return $phone;
        } elseif (is_string($phone)) {
            $completeNum = preg_replace('/[^0-9]/', '', $phone);
            $phoneData = [
                'areacode' => substr($completeNum, 0, 2),
                'phone' => substr($completeNum, 0, 2),
            ];
            return new self($phoneData);
        } elseif (is_array($phone)
            && array_key_exists('areacode', $phone)
            && array_key_exists('number', $phone)
        ) {
            return new self($phone);
        } else {
            throw new \InvalidArgumentException('Invalid Phone Data');
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
     * Get Area Code (DDD)
     * @return int
     */
    public function getAreacode()
    {
        return $this->areacode;
    }

    /**
     * Set Area Code (DDD)
     * @param int $areacode
     * @return Phone
     */
    public function setAreacode($areacode)
    {
        $filterNum = preg_replace('/[^0-9]/', '', $areacode);
        $this->areacode = $filterNum;
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
     * Set Number
     * @param string $number
     * @return Cpf
     */
    public function setNumber($number)
    {
        $filterNum = preg_replace('/[^0-9]/', '', $number);
        $this->number = $filterNum;
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
