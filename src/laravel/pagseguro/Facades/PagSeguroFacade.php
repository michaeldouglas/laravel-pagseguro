<?php

namespace laravel\pagseguro\Facades;

use laravel\pagseguro\Checkout\Facade\CheckoutFacade;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Address\Address;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Item\Item;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Remote\Url\Resolver;

/**
 * PagSeguro Facade
 * @author  Isaque de Souza <isaquesb@gmail.com>, Michael Douglas <michaeldouglas010790@gmail.com>
 */
class PagSeguroFacade
{

    /**
     * Get Default Credentials
     * @return Credentials
     */
    public function getCredentials()
    {
        $credentialsData = Config::get('credentials');
        return new Credentials(
            $credentialsData['token'],
            $credentialsData['email']
        );
    }

    /**
     * Create Address Instance
     * @param array $data
     * @return Address
     */
    public function createCheckoutFromArray(array $data)
    {
        $resolver = new Resolver();
        $data['redirectURL'] = $resolver->getRedirectURL();
        $data['notificationURL'] = $resolver->getNotificationURL();
        $createData = array_filter($data);
        $facade = new CheckoutFacade();
        $checkout = $facade->createFromArray($createData);
        return $checkout;
    }

    /**
     * Create Address Instance
     * @param array $data
     * @return Address
     */
    public function createAddress(array $data = [])
    {
        return new Address($data);
    }

    /**
     * Create Item Instance
     * @param array $data
     * @return Item
     */
    public function createItem(array $data = [])
    {
        return new Item($data);
    }

    /**
     * Create Item Collection Instance
     * @param array $data
     * @return ItemCollection
     * @throws \InvalidArgumentException
     */
    public function createItemCollection(array $data = [])
    {
        return ItemCollection::factory($data);
    }
}
