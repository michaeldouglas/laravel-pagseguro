<?php

namespace laravel\pagseguro\Sender\Phone;

use laravel\pagseguro\Complements\DataHydratorTrait;

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
    protected $areaCode;

    /**
     * Number
     * @var string
     */
    protected $number;

    use DataHydratorTrait;

    /**
     * Get Phone Instance
     * @param PhoneInterface|array $phone
     * @return PhoneInterface
     */
    public static function factory($phone)
    {
        if($phone instanceof PhoneInterface) {
            return $phone;
        } elseif(is_string($phone)) {
            $completeNum = preg_replace('/[^0-9]/', '', $phone);
            $phoneData = [
                'areaCode' => substr($completeNum, 0, 2),
                'number' => substr($completeNum, 0, 2),
            ];
            return new self($phoneData);
        } elseif(
            is_array($phone)
            && array_key_exists('areaCode', $phone)
            && array_key_exists('number', $phone)
        ) {
            return new self($phone);
        } else {
            throw new \InvalidArgumentException ('Invalid Phone Data');
        }
    }

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
     * Get Area Code (DDD)
     * @return int
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * Set Area Code (DDD)
     * @param int $areaCode
     * @return Phone
     */
    public function setAreaCode($areaCode)
    {
        $filterNum = preg_replace('/[^0-9]/', '', $areaCode);
        $this->areaCode = $filterNum;
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