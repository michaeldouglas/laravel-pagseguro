<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Phone\PhoneInterface;

/**
 * Cellphone Charger Checkout Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class CellphoneChargerCheckout extends SimpleCheckout
    implements CellphoneChargerCheckoutInterface
{

    /**
     * @var PhoneInterface
     */
    protected $phone;

    /**
     * @return PhoneInterface
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param PhoneInterface $phone
     * @return CellphoneChargerCheckout
     */
    public function setPhone(PhoneInterface $phone)
    {
        $this->phone = $phone;
        return $this;
    }
}
