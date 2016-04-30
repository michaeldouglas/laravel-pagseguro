<?php

namespace laravel\pagseguro\CreditCard\Installment;

/**
 * Installment Interface Object
 *
 * @category   Installment
 * @package    Laravel\PagSeguro\CreditCard\Installment
 *
 * @author     Eduardo Alves <eduardoalves.info@gmail.com>
 * @since      2016-04-21
 *
 * @copyright  Laravel\PagSeguro
 */
interface InstallmentInterface
{
    public function getQuantity();


    public function setQuantity($quantity);


    public function getValue();


    public function setValue($value);


    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = []);

    /**
     * Cast Array
     * @return array
     */
    public function toArray();


}