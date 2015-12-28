<?php

namespace Tests\Shipping;

use laravel\pagseguro\Shipping\Shipping;
use laravel\pagseguro\Address\Address;

/**
 * Shipping Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 * @covers \laravel\pagseguro\Shipping\Shipping
 */
class ShippingTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptySender()
    {
        $o = new Shipping();
        $this->assertEquals([
            'address' => null,
            'type' => null,
            'cost' => null,
        ], $o->toArray());
    }

    public function testSenderWithoutPhonesAndDocuments()
    {
        $data = [
            'address' => new Address([
                'postalCode' => '06410000',
                'street' => 'Rua da prata',
                'number' => '55',
                'complement' => '',
                'district' => 'Jardim dos Camargos',
                'city' => 'Barueri',
                'state' => 'SP',
                'country' => 'Brasil',
            ]),
            'type' => 1,
            'cost' => 25.78,
        ];
        $o = new Shipping($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['address'], $o->getAddress());
        $this->assertEquals($data['type'], $o->getType());
        $this->assertEquals($data['cost'], $o->getCost());
    }
}
