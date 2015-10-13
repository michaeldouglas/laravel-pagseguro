<?php

namespace Tests\Facades;

use laravel\pagseguro\Address\Address;
use laravel\pagseguro\Item\Item;
use laravel\pagseguro\Item\ItemInterface;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Payment\Payment;

/**
 * @covers laravel\pagseguro\Facades\PagSeguroFacade
 */
class PagSeguroFacadeTest extends \PHPUnit_Framework_TestCase
{
    
    public function testShouldCreateAddressObjectToBeUsedWithoutArguments()
    {
        $this->assertInstanceOf(
            Address::class,
            \laravel\pagseguro\Facades\PagSeguroFacade::createAddress()
        );
    }
    
    public function testShouldCreateAddressObjectToBeUsedWithArguments()
    {
        $this->assertInstanceOf(
            Address::class,
            \laravel\pagseguro\Facades\PagSeguroFacade::createAddress([
                'code' => 12
            ])
        );
    }
    
    public function testShouldCreateItemObjectToBeUsedWithoutArguments()
    {
        $item = \laravel\pagseguro\Facades\PagSeguroFacade::createItem();
        $this->assertInstanceOf(
            Item::class,
            $item
        );
        $this->assertInstanceOf(
            ItemInterface::class,
            $item
        );
    }
    
    public function testShouldCreateItemObjectToBeUsedWithArguments()
    {
        $item = \laravel\pagseguro\Facades\PagSeguroFacade::createItem([
            'myItem' => 'myValue'
        ]);
        $this->assertInstanceOf(
            Item::class,
            $item
        );
    }
    
    public function testShouldCreateItemCollectionObjectToBeUsedWithoutArguments()
    {
        $item = \laravel\pagseguro\Facades\PagSeguroFacade::createItemCollection();
        $this->assertInstanceOf(
            ItemCollection::class,
            $item
        );
        $this->assertInstanceOf(
            '\ArrayObject',
            $item
        );
    }
    
    public function testShouldCreateItemCollectionObjectToBeUsedWithArguments()
    {
        $item = $this->getMock('\laravel\pagseguro\Item\ItemInterface');
        $itemCollection = \laravel\pagseguro\Facades\PagSeguroFacade::createItemCollection([
            'myArgument' => $item
        ]);
        $this->assertInstanceOf(
            ItemCollection::class,
            $itemCollection
        );
        $this->assertInstanceOf(
            '\ArrayObject',
            $itemCollection
        );
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldThrowAnExceptionWhenCreatesItemCollectionWithInvalidArgument()
    {
        \laravel\pagseguro\Facades\PagSeguroFacade::createItemCollection([
            'myArgument' => 'myValue'
        ]);
    }
    
    public function testShouldCreatePaymentObjectToBeUsed()
    {
        $this->assertInstanceOf(
            Payment::class,
            \laravel\pagseguro\Facades\PagSeguroFacade::createPaymentRequest()
        );
    }
}
