<?php

namespace laravel\pagseguro\Facades;
use laravel\pagseguro\CreditCard\CreditCard;

/**
 * PagSeguro Facade
 * @author  Isaque de Souza <isaquesb@gmail.com>
 */
class PagSeguro
{

    /**
     * @return Checkout
     */
    public function checkout()
    {
        return new Checkout();
    }

    /**
     * @return Credentials
     */
    public function credentials()
    {
        return new Credentials();
    }

    /**
     * @return Item
     */
    public function item()
    {
        return new Item();
    }

    /**
     * @return Item
     */
    public function creditCard()
    {
        return new CreditCard();
    }

    /**
     * @return Transaction
     */
    public function transaction()
    {
        return new Transaction();
    }

    /**
     * @return Transaction
     */
    public function session()
    {
        return new Session();
    }
}
