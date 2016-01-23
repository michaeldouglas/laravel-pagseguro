<?php

namespace laravel\pagseguro\Tests\Unit\Address;

use laravel\pagseguro\Address\Address;

/**
 * Address Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class AddressTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyAddress()
    {
        $address = new Address();
        $this->assertEquals([
            'postalCode' => null,
            'street' => null,
            'number' => null,
            'complement' => null,
            'district' => null,
            'city' => null,
            'state' => null,
            'country' => null,
        ], $address->toArray());
    }

    public function testFullAddress()
    {
        $data = [
            'postalCode' => '06410000',
            'street' => 'Rua da prata',
            'number' => '55',
            'complement' => '',
            'district' => 'Jardim dos Camargos',
            'city' => 'Barueri',
            'state' => 'SP',
            'country' => 'Brasil',
        ];
        $address = new Address($data);
        $this->assertEquals($data, $address->toArray());
        $this->assertEquals($data['postalCode'], $address->getPostalCode());
        $this->assertEquals($data['street'], $address->getStreet());
        $this->assertEquals($data['number'], $address->getNumber());
        $this->assertEquals($data['complement'], $address->getComplement());
        $this->assertEquals($data['district'], $address->getDistrict());
        $this->assertEquals($data['city'], $address->getCity());
        $this->assertEquals($data['state'], $address->getState());
        $this->assertEquals($data['country'], $address->getCountry());
    }
}
