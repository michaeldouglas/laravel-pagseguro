<?php

namespace Test\Payment;

use laravel\pagseguro\Payment\Payment;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Item\Item;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Address\Address;

/**
 * @covers laravel\pagseguro\Payment\Payment
 */
class PaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldCreatePaymentObject()
    {
        $payment = new Payment();
        
        $this->assertInstanceOf('\laravel\pagseguro\Payment\Payment', $payment);
    }
    
    public function testShouldOverrideCredentialsGivenInContructor()
    {
        $payment = new Payment(new Credentials(
            '12312312aaajjhsisi$$as1',
            'matheus.marabesi@gmail.com'
        ));
        
        $payment->setCredentials(new Credentials(
            '12312312aaajjhsisi$$as1',
            'matheus.marabesi@gmail.com'
        ));
    }
    
    public function testShouldAddNewItem()
    {
        $payment = new Payment();
        
        $fluentInterface = $payment->addItem(new Item());
        
        $this->assertEquals(1, $payment->getItems()->count());
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            $fluentInterface
        );
    }
    
    public function testShouldAddNewItemCollectionAndOverrideItemSettedsPreviously()
    {
        $payment = new Payment();
        
        $payment->addItem(new Item());
        
        $payment->setItemCollection(new ItemCollection());
        
        $this->assertEquals(0, $payment->getItems()->count());
    }
    
    public function testShouldAddNewItemCollectionFromArrayAndOverrideItemSettedsPreviously()
    {
        $payment = new Payment();
        
        $payment->addItem(new Item());
        
        $payment->setItemCollectionFromArray([
            new Item(),
            new Item(),
        ]);
        
        $this->assertEquals(2, $payment->getItems()->count());
    }
    
    public function testShouldDefineReferenceToThePayment()
    {
        $payment = new Payment();
        
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            $payment->setReference('MYREF')
        );
    }
    
    public function testShouldDefineCurrencyToThePayment()
    {
        $payment = new Payment();
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            $payment->setCurrency('EU')
        );
        
        $this->assertEquals('EU', $payment->getCurrency());
    }
    
    public function testShouldDefineAshippingType()
    {
        $payment = new Payment();
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            $payment->setShippingType()
        );
        
        $this->assertEquals(1, $payment->getShipping());
        
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            $payment->setShippingType(2)
        );
        
        $this->assertEquals(2, $payment->getShipping());
    }
    
    public function testShouldDefineAaddress()
    {
        $payment = new Payment();
        
        $address = new Address();
        $address->setCity('São Paulos');
        
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            $payment->setAddress($address)
        );
        
        $this->assertInstanceOf(
            'laravel\pagseguro\Address\Address',
            $payment->getAddress()
        );
        
        $this->assertEquals('São Paulos', $payment->getAddress()->getCity());
        $this->assertSame($address, $payment->getAddress());
    }
    
    public function testShouldDefineSenderToBeUsed()
    {
        $payment = new Payment();
        
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            $payment->setSender([
                'sender' => [
                    'name' => 'Matheus Marabesi'
                ]
            ])
        );
        
        $this->assertInstanceOf(
            '\laravel\pagseguro\Sender\Sender',
            $payment->getSender()
        );
    }
}
