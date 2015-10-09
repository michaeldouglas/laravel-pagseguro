<?php

namespace Tests\Facades;

/**
 * @covers laravel\pagseguro\Facades\PagSeguroFacade
 */
class PagSeguroFacadeTest extends \PHPUnit_Framework_TestCase
{
    
    public function testShouldCreateAddressObjectToBeUsedWithoutArguments()
    {
        $this->assertInstanceOf(
            '\laravel\pagseguro\Address\Address',
            \laravel\pagseguro\Facades\PagSeguroFacade::createAddress()
        );
    }
    
    public function testShouldCreateAddressObjectToBeUsedWithArguments()
    {
        $this->assertInstanceOf(
            '\laravel\pagseguro\Address\Address',
            \laravel\pagseguro\Facades\PagSeguroFacade::createAddress([
                'code' => 12
            ])
        );
    }
    
    public function testShouldCreateItemObjectToBeUsedWithoutArguments()
    {
        $item = \laravel\pagseguro\Facades\PagSeguroFacade::createItem();
        $this->assertInstanceOf(
            '\laravel\pagseguro\Item\Item',
            $item
        );
        $this->assertInstanceOf(
            '\laravel\pagseguro\Item\ItemInterface',
            $item
        );
    }
    
    public function testShouldCreateItemObjectToBeUsedWithArguments()
    {
        $item = \laravel\pagseguro\Facades\PagSeguroFacade::createItem([
            'myItem' => 'myValue'
        ]);
        $this->assertInstanceOf(
            '\laravel\pagseguro\Item\Item',
            $item
        );
    }
    
    public function testShouldCreateItemCollectionObjectToBeUsedWithoutArguments()
    {
        $item = \laravel\pagseguro\Facades\PagSeguroFacade::createItemCollection();
        $this->assertInstanceOf(
            '\laravel\pagseguro\Item\ItemCollection',
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
            '\laravel\pagseguro\Item\ItemCollection',
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
        $itemCollection = \laravel\pagseguro\Facades\PagSeguroFacade::createItemCollection([
            'myArgument' => 'myValue'
        ]);
        $this->assertInstanceOf(
            '\laravel\pagseguro\Item\ItemCollection',
            $itemCollection
        );
    }
    
    public function testShouldCreatePaymentObjectToBeUsed()
    {
        $this->assertInstanceOf(
            '\laravel\pagseguro\Payment\Payment',
            \laravel\pagseguro\Facades\PagSeguroFacade::createPaymentRequest()
        );
    }
}
