<?php

namespace laravel\pagseguro\Phone;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Document\CPF\CPF;

/**
 * Phone Object
 *
 * @category   Phone
 * @package    Laravel\PagSeguro\Phone
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
     * @var int
     */
    protected $areaCode;

    /**
     * Country Code
     * @var int
     */
    protected $countryCode = '55';

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
            $matches = null;
            $exp = '/^([\d]{2})?([\d]{2})([\d]{8,})$/';
            preg_match($exp, preg_replace('/[^\d]/', '', $phone), $matches);
            if (!$matches) {
                throw new \InvalidArgumentException('Error on phone parse');
            }
            $phoneData = [
                'areaCode' => $matches[2],
                'countryCode' => $matches[1] ? $matches[1] : '55',
                'number' => $matches[3],
            ];
            return new self($phoneData);
        } elseif (is_array($phone)
            && array_key_exists('areaCode', $phone)
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
        $filterNum = preg_replace('/[^\d]/', '', $areaCode);
        $this->areaCode = $filterNum;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param int $countryCode
     * @return Phone
     */
    public function setCountryCode($countryCode)
    {
        $filterNum = preg_replace('/[^\d]/', '', $countryCode);
        $this->countryCode = $filterNum;
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
        $filterNum = preg_replace('/[^\d]/', '', $number);
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
