<?php

namespace laravel\pagseguro\Facades;

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
     * @return Transaction
     */
    public function transaction()
    {
        return new Transaction();
    }
}
