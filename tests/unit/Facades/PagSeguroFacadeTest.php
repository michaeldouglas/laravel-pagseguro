<?php

namespace laravel\pagseguro\Tests\Unit\Facades;

use laravel\pagseguro\Address\Address;
use laravel\pagseguro\Facades\PagSeguroFacade;
use laravel\pagseguro\Item\Item;
use laravel\pagseguro\Item\ItemInterface;
use laravel\pagseguro\Item\ItemCollection;

/**
 * @covers laravel\pagseguro\Facades\PagSeguroFacade
 */
class PagSeguroFacadeTest extends \PHPUnit_Framework_TestCase
{
    
    public function testShouldCreateAddressObjectToBeUsedWithoutArguments()
    {
        $instance = new PagSeguroFacade();
        $this->assertInstanceOf(Address::class, $instance->createAddress());
    }
    
    public function testShouldCreateAddressObjectToBeUsedWithArguments()
    {
        $instance = new PagSeguroFacade();
        $this->assertInstanceOf(
            Address::class,
            $instance->createAddress([
                'code' => 12
            ])
        );
    }
    
    public function testShouldCreateItemObjectToBeUsedWithoutArguments()
    {
        $instance = new PagSeguroFacade();
        $item = $instance->createItem();
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
        $instance = new PagSeguroFacade();
        $item = $instance->createItem([
            'myItem' => 'myValue'
        ]);
        $this->assertInstanceOf(
            Item::class,
            $item
        );
    }
    
    public function testShouldCreateItemCollectionObjectToBeUsedWithoutArguments()
    {
        $instance = new PagSeguroFacade();
        $item = $instance->createItemCollection();
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
        $instance = new PagSeguroFacade();
        $item = $this->getMock('\laravel\pagseguro\Item\ItemInterface');
        $itemCollection = $instance->createItemCollection([
            'myArgument' => $item
        ]);
        $this->assertInstanceOf(ItemCollection::class, $itemCollection);
        $this->assertInstanceOf('\ArrayObject', $itemCollection);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldThrowAnExceptionWhenCreatesItemCollectionWithInvalidArgument()
    {
        $instance = new PagSeguroFacade();
        $instance->createItemCollection([
            'myArgument' => 'myValue'
        ]);
    }
}
