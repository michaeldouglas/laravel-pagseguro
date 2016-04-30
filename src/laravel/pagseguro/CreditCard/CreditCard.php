<?php

namespace laravel\pagseguro\CreditCard;

use laravel\pagseguro\Address\AddressInterface;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\CreditCard\Installment\Installment;
use laravel\pagseguro\Document\DocumentCollection;
use laravel\pagseguro\Phone\Phone;
use laravel\pagseguro\Phone\PhoneInterface;

/**
 * CreditCard Object
 *
 * @category   CreditCard
 * @package    Laravel\PagSeguro\CreditCard
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>, Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
class CreditCard implements CreditCardInterface
{

    /**
     * Hash
     * @var string
     */
    protected $token;

    protected $installment;
    
    /**
     * Name (Nome)
     * @var string
     */
    protected $name;

    /**
     * Phone Number (Telefone)
     * @var PhoneInterface
     */
    protected $phone;

    /**
     * Documents (Lista de Documentos: CPF)
     * @var DocumentCollection
     */
    protected $documents;

    /**
     * Birth Date (Data de nascimento)
     * @var string
     */
    protected $birthDate;

    /**
     * BillingAddress
     * @var AddressInterface
     */
    protected $billingAddress;

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
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    /**
     * Get Name (Nome)
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Phone (Telefone)
     * @return PhoneInterface
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get Documents (Lista de Documentos)
     * @return DocumentCollection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Get Birth Date (Data de Nascimento)
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set Token
     * @param string $token
     * @return Token
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Set Installment $installment
     * @param mixed $installment
     * @return Installment
     */
    public function setInstallment($installment)
    {
        if (is_array($installment)) {
            $installment = Installment::factory($installment);
        }
        $this->installment = $installment;
        return $this;
    }
    
    /**
     * Set Name
     * @param string $name
     * @return AddressInterface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set Phone (Telefone)
     * @param PhoneInterface|array $phone
     * @return AddressInterface
     */
    public function setPhone($phone)
    {
        if (!is_null($phone)) {
            $this->phone = Phone::factory($phone);
        } else {
            $this->phone = null;
        }
        return $this;
    }

    /**
     * Set Documents (Lista de Documentos)
     * @param DocumentCollection|array $documents
     * @return AddressInterface
     */
    public function setDocuments($documents)
    {
        if (is_array($documents)) {
            $documents = DocumentCollection::factory($documents);
        }
        $this->documents = $documents;
        return $this;
    }

    /**
     * Set Birth Date (Data de nascimento)
     * @param string $birthDate
     * @return AddressInterface
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * Set Billing Address
     * @param mixed $billingAddress
     * @return AddressInterface
     */
    public function setBillingAddress(AddressInterface $billingAddress)
    {
        $this->billingAddress = $billingAddress;
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
