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
		
		if (!isset($data['redirectURL']))
		{
			$data['redirectURL'] = $resolver->getRedirectURL();
		}
		
        if (!isset($data['notificationURL']))
        {
			$data['notificationURL'] = $resolver->getNotificationURL();
		}
        
        // array_filter: If no callback is supplied, all entries of array 
        // equal to FALSE will be removed.
        $createData = array_filter($data);
        $facade = new CheckoutFacade();
        $checkout = $facade->createFromArray($createData);
        return $checkout;
    }
}
