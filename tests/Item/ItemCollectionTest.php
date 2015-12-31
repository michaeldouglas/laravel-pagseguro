<?php

namespace Tests\Item;

use laravel\pagseguro\Item\Item;
use laravel\pagseguro\Item\ItemCollection;

/**
 * Item Collection Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 * @covers \laravel\pagseguro\Item\ItemCollection
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
        $o = ItemCollection::factory([$item]);
        $this->assertInstanceOf(ItemCollection::class, $o);
        $this->assertCount(1, $o);
        $this->assertEquals(new Item($item), $o->offsetGet(0));
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
        $o = ItemCollection::factory([$item]);
        $this->assertInstanceOf(ItemCollection::class, $o);
        $this->assertCount(1, $o);
        $this->assertEquals($item, $o->offsetGet(0));
    }

    /**
     * Test With Empty Data
     */
    public function testWithEmpty()
    {
        $o = ItemCollection::factory();
        $this->assertInstanceOf(ItemCollection::class, $o);
        $this->assertCount(0, $o);
    }
}
