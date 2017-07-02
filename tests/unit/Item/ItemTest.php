<?php

namespace laravel\pagseguro\Tests\Unit\Item;

use laravel\pagseguro\Item\Item;

/**
 * Item Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyItem()
    {
        $item = new Item();
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
        ], $item->toArray());
    }

    public function testFullItem()
    {
        $data = [
            'description' => 'Laravel PS',
            'quantity' => '777',
            'weight' => '999',
            'shippingCost' => '666',
            'width' => 555,
            'height' => '444',
            'length' => '333',
            'amount' => '888',
            'id' => 1,
        ];
        $item = new Item($data);
        $this->assertEquals($data, $item->toArray());
        $this->assertEquals($data['id'], $item->getId());
        $this->assertEquals($data['description'], $item->getDescription());
        $this->assertEquals($data['quantity'], $item->getQuantity());
        $this->assertEquals($data['amount'], $item->getAmount());
        $this->assertEquals($data['weight'], $item->getWeight());
        $this->assertEquals($data['shippingCost'], $item->getShippingCost());
        $this->assertEquals($data['width'], $item->getWidth());
        $this->assertEquals($data['height'], $item->getHeight());
        $this->assertEquals($data['length'], $item->getLength());
    }
}
