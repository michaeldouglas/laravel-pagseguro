<?php

namespace Tests\Item;

use laravel\pagseguro\Item\Item;

/**
 * Item Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 * @covers \laravel\pagseguro\Item\Item
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyItem()
    {
        $o = new Item();
        $this->assertEquals([
            'id' => null,
            'description' => null,
            'quantity' => null,
            'amount' => null,
            'weight' => null,
            'shippingCost' => null,
            'width' => null,
            'height' => null,
            'length' => null,
        ], $o->toArray());
    }

    public function testFullItem()
    {
        $data = [
            'id' => '1',
            'description' => 'Laravel PS',
            'quantity' => '777',
            'amount' => '888',
            'weight' => '999',
            'shippingCost' => '666',
            'width' => '555',
            'height' => '444',
            'length' => '333',
        ];
        $o = new Item($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['id'], $o->getId());
        $this->assertEquals($data['description'], $o->getDescription());
        $this->assertEquals($data['quantity'], $o->getQuantity());
        $this->assertEquals($data['amount'], $o->getAmount());
        $this->assertEquals($data['weight'], $o->getWeight());
        $this->assertEquals($data['shippingCost'], $o->getShippingCost());
        $this->assertEquals($data['width'], $o->getWidth());
        $this->assertEquals($data['height'], $o->getHeight());
        $this->assertEquals($data['length'], $o->getLength());
    }
}
