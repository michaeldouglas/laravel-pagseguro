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
    public $senderAreaCode;

    /**
     * Number
     * @var string
     */
    protected $senderPhone;
    
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
                'senderAreaCode' => substr($completeNum, 0, 2),
                'senderPhone' => substr($completeNum, 2, 9),
            ];
            return new self($phoneData);
        } elseif (is_array($phone)
            && array_key_exists('senderAreaCode', $phone)
            && array_key_exists('senderPhone', $phone)
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
    public function getSenderAreaCode()
    {
        return $this->senderAreaCode;
    }

    /**
     * Set Area Code (DDD)
     * @param int $senderAreaCode
     * @return Phone
     */
    public function setSenderAreaCode($senderAreaCode)
    {
        $filterNum = preg_replace('/[^0-9]/', '', $senderAreaCode);
        $this->senderAreaCode = $filterNum;
        return $this;
    }

    /**
     * Get Number
     * @return string
     */
    public function getSenderPhone()
    {
        return $this->senderPhone;
    }

    /**
     * Set Number
     * @param string $senderPhone
     * @return Cpf
     */
    public function setSenderPhone($senderPhone)
    {
        $filterNum = preg_replace('/[^0-9]/', '', $senderPhone);
        $this->senderPhone = $filterNum;
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
