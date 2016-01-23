<?php

namespace laravel\pagseguro\Tests\Unit\Checkout;

use laravel\pagseguro\Shipping\ShippingInterface;

/**
 * Simple Checkout Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class SimpleCheckoutTest extends CheckoutBase
{
    public function testStdCheckout()
    {
        $checkout = $this->checkout;
        $this->assertEquals(1, $checkout->getItems()->count());
        $this->assertEquals('985445522', $checkout->getSender()->getPhone()->getNumber());
        $this->assertEquals('Rua da Selva', $checkout->getShipping()->getAddress()->getStreet());
        $this->assertEquals(ShippingInterface::TYPE_SEDEX, $checkout->getShipping()->getType());
        $this->assertEquals('BRL', $checkout->getCurrency());
    }
}
