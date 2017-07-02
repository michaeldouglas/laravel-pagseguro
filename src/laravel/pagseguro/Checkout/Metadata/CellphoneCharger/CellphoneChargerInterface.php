<?php

namespace laravel\pagseguro\Checkout\Metadata\CellphoneCharger;

use laravel\pagseguro\Checkout\CheckoutInterface;
use laravel\pagseguro\Phone\PhoneInterface;

/**
 * Cellphone Charge Checkout Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface CellphoneChargerInterface
{

    /**
     * @return PhoneInterface
     */
    public function getPhone();

    /**
     * @param PhoneInterface $phone
     * @return CheckoutInterface
     */
    public function setPhone(PhoneInterface $phone);
}
