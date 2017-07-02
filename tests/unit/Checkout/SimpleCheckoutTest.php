<?php

namespace laravel\pagseguro\Tests\Unit\Checkout;

use laravel\pagseguro\Shipping\ShippingInterface;

/**
 * Simple Checkout Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class SimpleCheckoutTest extends CheckoutBase
{

    public function testCheckout()
    {
        $checkout = $this->checkout;
        $site = 'http://www.meusite.com.br';
        $this->assertEquals('BRL', $checkout->getCurrency());
        $this->assertEquals($site, $checkout->getRedirectURL());
        $this->assertEquals($site . '/notification', $checkout->getNotificationURL());
        $this->assertEquals('UTF-8', $checkout->getCharset());
        $this->assertNull($checkout->getMaxAge());
        $this->assertNull($checkout->getMaxUses());
        $this->assertNull($checkout->getExtraAmount());
    }

    public function testCheckoutItems()
    {
        $checkout = $this->checkout;
        $items = $checkout->getItems();
        $this->assertEquals(1, $items->count());
    }

    public function testCheckoutSender()
    {
        $sender = $this->checkout->getSender();
        $class = '\\laravel\\pagseguro\\Sender\\Sender';
        $this->assertInstanceOf($class, $sender);
    }

    public function testCheckoutShipping()
    {
        $class = '\\laravel\\pagseguro\\Shipping\\Shipping';
        $this->assertInstanceOf($class, $this->checkout->getShipping());
    }

    /**
     * @depends testCheckoutItems
     */
    public function testCheckoutItem()
    {
        $item = $this->checkout->getItems()->offsetGet(0);
        $this->assertEquals('18', $item->getId());
        $this->assertEquals('Laravel PS', $item->getDescription());
        $this->assertEquals(40, $item->getQuantity());
        $this->assertEquals(784.60, $item->getAmount());
        $this->assertEquals(45, $item->getWeight());
        $this->assertEquals(666, $item->getShippingCost());
        $this->assertEquals(665, $item->getWidth());
        $this->assertEquals(445, $item->getHeight());
        $this->assertEquals(669, $item->getLength());
    }

    /**
     * @depends testCheckoutSender
     */
    public function testCheckoutSenderData()
    {
        $docsInstance = '\\laravel\\pagseguro\\Document\\DocumentCollection';
        $phoneInstance = '\\laravel\\pagseguro\\Phone\\Phone';
        $sender = $this->checkout->getSender();
        $this->assertEquals('Isaque de Souza Barbosa', $sender->getName());
        $this->assertEquals('isaquesb@gmail.com', $sender->getEmail());
        $this->assertEquals('1988-03-25', $sender->getBornDate());
        $this->assertInstanceOf($docsInstance, $sender->getDocuments());
        $this->assertInstanceOf($phoneInstance, $sender->getPhone());
    }

    /**
     * @depends testCheckoutSenderData
     */
    public function testCheckoutSenderPhone()
    {
        $phone = $this->checkout->getSender()->getPhone();
        $this->assertEquals('55', $phone->getCountryCode());
        $this->assertEquals('11', $phone->getAreaCode());
        $this->assertEquals('985445522', $phone->getNumber());
    }

    /**
     * @depends testCheckoutSenderData
     */
    public function testCheckoutSenderDocs()
    {
        $docs = $this->checkout->getSender()->getDocuments();
        $this->assertEquals(1, $docs->count());
        $doc = $docs->offsetGet(0);
        $this->assertEquals('80808080822', $doc->getNumber());
        $this->assertEquals('CPF', $doc->getType());
    }

    /**
     * @depends testCheckoutShipping
     */
    public function testCheckoutShippingData()
    {
        $shipping = $this->checkout->getShipping();
        $addressClass = 'laravel\\pagseguro\\Address\\Address';
        $this->assertEquals(ShippingInterface::TYPE_SEDEX, $shipping->getType());
        $this->assertEquals(30.4, $shipping->getCost());
        $this->assertInstanceOf($addressClass, $shipping->getAddress());
    }

    /**
     * @depends testCheckoutShipping
     */
    public function testCheckoutShippingAddress()
    {
        $address = $this->checkout->getShipping()->getAddress();
        $this->assertEquals('06410030', $address->getPostalCode());
        $this->assertEquals('Rua da Selva', $address->getStreet());
        $this->assertEquals(12, $address->getNumber());
        $this->assertEquals('Jardim dos Camargos', $address->getDistrict());
        $this->assertEquals('Barueri', $address->getCity());
        $this->assertEquals('SP', $address->getState());
        $this->assertEquals('BRA', $address->getCountry());
        $this->assertNull($address->getComplement());
    }
}
