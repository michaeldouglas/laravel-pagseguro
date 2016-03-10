<?php

namespace laravel\pagseguro\Facades;

use laravel\pagseguro\Checkout\CheckoutInterface;
use laravel\pagseguro\Checkout\Facade\CheckoutFacade;
use laravel\pagseguro\Remote\Url\Resolver;

/**
 * Checkout Facade
 * @author  Isaque de Souza <isaquesb@gmail.com>
 */
class Checkout
{

    /**
     * Create Address Instance
     * @param array $data
     * @return CheckoutInterface
     */
    public function createFromArray(array $data)
    {
        $resolver = new Resolver();
        if (!array_key_exists('redirectURL', $data)) {
            $data['redirectURL'] = $resolver->getRedirectURL();
        }
        if (!array_key_exists('notificationURL', $data)) {
            $data['notificationURL'] = $resolver->getNotificationURL();
        }
        $createData = array_filter($data);
        $facade = new CheckoutFacade();
        $checkout = $facade->createFromArray($createData);
        return $checkout;
    }
}
