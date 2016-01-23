<?php

namespace laravel\pagseguro\Tests\Unit\Phone;

use laravel\pagseguro\Phone\Phone;

/**
 * Phone Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class PhoneTest extends \PHPUnit_Framework_TestCase
{

    public function testStdPhone()
    {
        $phone = new Phone();
        $this->assertEquals([
            'areaCode' => null,
            'countryCode' => '55',
            'number' => null,
        ], $phone->toArray());
    }

    public function testArrayFactory()
    {
        $data = [
            'areaCode' => '11',
            'countryCode' => '54',
            'number' => '980848055'
        ];
        $phone = new Phone($data);
        $this->assertEquals($data, $phone->toArray());
        $this->assertEquals($data['areaCode'], $phone->getAreaCode());
        $this->assertEquals($data['countryCode'], $phone->getCountryCode());
        $this->assertEquals($data['number'], $phone->getNumber());
    }

    public function testStringFactory()
    {
        $phone = Phone::factory('5411980848055');
        $this->assertEquals('11', $phone->getAreaCode());
        $this->assertEquals('54', $phone->getCountryCode());
        $this->assertEquals('980848055', $phone->getNumber());
    }

    public function testStringFactoryWithoutDdi()
    {
        $phone = Phone::factory('11980848055');
        $this->assertEquals('11', $phone->getAreaCode());
        $this->assertEquals('55', $phone->getCountryCode());
        $this->assertEquals('980848055', $phone->getNumber());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testStringFactoryWithoutDdiAndDdd()
    {
        Phone::factory('980848055');
    }
}
