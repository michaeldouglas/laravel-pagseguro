<?php

namespace laravel\pagseguro\Sender;

/**
 * Sender Interface
 *
 * @category   Sender
 * @package    Laravel\PagSeguro\Sender
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-08-11
 *
 * @copyright  Laravel\PagSeguro
 */
interface SenderInterface
{

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = []);

    /**
     * Get E-mail
     * @return string
     */
    public function getEmail();

    /**
     * Get Name (Nome)
     * @return string
     */
    public function getSenderName();

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
     * Set Email
     * @param string $email
     * @return Address
     */
    public function setEmail($email);

    /**
     * Set Name
     * @param string $name
     * @return Address
     */
    public function setSenderName($name);

    /**
     * Set Phone (Telefone)
     * @param PhoneInterface|array $phone
     * @return Address
     */
    public function setPhone($phone);

    /**
     * Set Documents (Lista de Documentos)
     * @param DocumentCollection|array|string $documents
     * @return Address
     */
    public function setDocuments($documents);

    /**
     * Set Born Date (Data de nascimento)
     * @param string $bornDate
     * @return Address
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
     * @return null|Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
