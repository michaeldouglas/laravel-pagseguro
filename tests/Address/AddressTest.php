<?php

namespace Tests\Address;

use \laravel\pagseguro\Address\Address;

/**
 * Address Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class AddressTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyAddress()
    {
        $o = new Address();
        $this->assertEquals([
            'postalCode' => null,
            'street' => null,
            'number' => null,
            'complement' => null,
            'district' => null,
            'city' => null,
            'state' => null,
            'country' => null,
        ], $o->toArray());
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
        $o = new Address($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['postalCode'], $o->getPostalCode());
        $this->assertEquals($data['street'], $o->getStreet());
        $this->assertEquals($data['number'], $o->getNumber());
        $this->assertEquals($data['complement'], $o->getComplement());
        $this->assertEquals($data['district'], $o->getDistrict());
        $this->assertEquals($data['city'], $o->getCity());
        $this->assertEquals($data['state'], $o->getState());
        $this->assertEquals($data['country'], $o->getCountry());
    }
}
