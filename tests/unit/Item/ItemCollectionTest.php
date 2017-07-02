<?php

namespace laravel\pagseguro\Tests\Unit\Item;

use laravel\pagseguro\Item\Item;
use laravel\pagseguro\Item\ItemCollection;

/**
 * Item Collection Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class ItemCollectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test With Integer
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testWithInteger()
    {
        ItemCollection::factory([1]);
    }

    /**
     * Test With String
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testWithString()
    {
        ItemCollection::factory(['Meu Item']);
    }

    /**
     * Test With Object
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testWithObject()
    {
        $item = new \stdClass();
        ItemCollection::factory([$item]);
    }

    /**
     * Test With Array
     */
    public function testWithArray()
    {
        $item = [];
        $itemCollection = ItemCollection::factory([$item]);
        $this->assertInstanceOf('\laravel\pagseguro\Item\ItemCollection', $itemCollection);
        $this->assertCount(1, $itemCollection);
        $this->assertEquals(new Item($item), $itemCollection->offsetGet(0));
    }

    /**
     * Test With Item
     */
    public function testWithItem()
    {
        $item = new Item([
            'id' => '1',
            'description' => 'Laravel PS',
            'quantity' => '777',
            'amount' => '888',
            'weight' => '999',
            'shippingCost' => '666',
            'width' => '555',
            'height' => '444',
            'length' => '333',
        ]);
        $collection = ItemCollection::factory([$item]);
        $this->assertInstanceOf('\laravel\pagseguro\Item\ItemCollection', $collection);
        $this->assertCount(1, $collection);
        $this->assertEquals($item, $collection->offsetGet(0));
    }

    /**
     * Test With Empty Data
     */
    public function testWithEmpty()
    {
        $collection = ItemCollection::factory();
        $this->assertInstanceOf('\laravel\pagseguro\Item\ItemCollection', $collection);
        $this->assertCount(0, $collection);
    }
}
