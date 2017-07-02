<?php

namespace laravel\pagseguro\Tests\Unit\Shipping;

use laravel\pagseguro\Shipping\Shipping;
use laravel\pagseguro\Address\Address;

/**
 * Shipping Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class ShippingTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptySender()
    {
        $shipping = new Shipping();
        $this->assertEquals([
            'address' => null,
            'type' => null,
            'cost' => null,
        ], $shipping->toArray());
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
        $shipping = new Shipping($data);
        $this->assertEquals($data, $shipping->toArray());
        $this->assertEquals($data['address'], $shipping->getAddress());
        $this->assertEquals($data['type'], $shipping->getType());
        $this->assertEquals($data['cost'], $shipping->getCost());
    }
}
