<?php

namespace laravel\pagseguro\CreditCard;

use laravel\pagseguro\Document\DocumentCollection;
use laravel\pagseguro\Phone\PhoneInterface;

/**
 * CreditCard Interface
 *
 * @category   CreditCard
 * @package    Laravel\PagSeguro\CreditCard
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-08-11
 *
 * @copyright  Laravel\PagSeguro
 */
interface CreditCardInterface
{

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = []);

    /**
     * Get Token
     * @return string
     */
    public function getToken();

    /**
     * Get Name (Nome)
     * @return string
     */
    public function getName();

    /**
     * Get Phone (Telefone)
     * @return PhoneInterface
     */
    public function getPhone();

    /**
     * Get Documents (Lista de Documentos)
     * @return DocumentCollection
     */
    public function getDocuments();

    /**
     * Get Born Date (Data de Nascimento)
     * @return string
     */
    public function getBornDate();

    /**
     * Set Token
     * @param string $token
     * @return SenderInterface
     */
    public function setToken($token);

    /**
     * Set Name
     * @param string $name
     * @return SenderInterface
     */
    public function setName($name);

    /**
     * Set Phone (Telefone)
     * @param PhoneInterface|array $phone
     * @return SenderInterface
     */
    public function setPhone($phone);

    /**
     * Set Documents (Lista de Documentos)
     * @param DocumentCollection|array|string $documents
     * @return SenderInterface
     */
    public function setDocuments($documents);

    /**
     * Set Born Date (Data de nascimento)
     * @param string $bornDate
     * @return SenderInterface
     */
    public function setBornDate($bornDate);

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = []);

    /**
     * Test Valid Data
     * @return bool
     */
    public function isValid();

    /**
     * Get Validator
     * Return only after hydrate
     * @return null|\Illuminate\Validation\Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
