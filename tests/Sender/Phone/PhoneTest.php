<?php

namespace Tests\Sender\Phone;

use \laravel\pagseguro\Sender\Phone\Phone;
use laravel\pagseguro\Sender\Phone\PhoneInterface;

/**
 * Sender Phone Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 * @covers \laravel\pagseguro\Sender\Phone\Phone
 */
class PhoneTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyCPF()
    {
        $o = new Phone();
        $this->assertEquals([
            'senderAreaCode' => null,
            'senderPhone' => null,
                ], $o->toArray());
    }

    public function testCpf()
    {
        $data = [
            'senderAreaCode' => 11,
            'senderPhone' => 912345678,
        ];
        $o = new Phone($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['senderAreaCode'], $o->getSenderAreaCode());
        $this->assertEquals($data['senderPhone'], $o->getSenderPhone());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldFailGivenInvalidPhone()
    {
        Phone::factory([]);
    }

    public function testShouldUsePhoneObject()
    {
        $myPhone = new MyPhone();
        $phoneInstance = Phone::factory($myPhone);
        $this->assertSame($myPhone, $phoneInstance);
    }

    public function testShouldReturnPhoneObjectFromArray()
    {
        $phone = Phone::factory([
                    'senderAreaCode' => 11,
                    'senderPhone' => 12341234
        ]);
        $this->assertInstanceOf('laravel\pagseguro\Sender\Phone\Phone', $phone);
    }

    /**
     * @dataProvider phoneProvider
     */
    public function testShouldReturnPhoneObjectFromString($phoneInput)
    {
        $phone = Phone::factory($phoneInput);
        $this->assertInstanceOf('laravel\pagseguro\Sender\Phone\Phone', $phone);
    }

    public function testShouldCreatePhoneObject()
    {
        $this->assertInstanceOf(
                'laravel\pagseguro\Sender\Phone\Phone', new Phone()
        );

        $this->assertInstanceOf(
                'laravel\pagseguro\Sender\Phone\Phone', new Phone([123456])
        );
    }

    public function testShouldAnewReturnValidationRulesObject()
    {
        $phone = new Phone();
        $validationRules = $phone->getValidationRules();

        $this->assertNotSame($phone->getValidationRules(), $validationRules);
    }
    
    public function testGenerateFormatedPhoneFromString()
    {
        $phoneFactory = new Phone();
        $phone = $phoneFactory->factory('1112341234');
        
        $this->assertEquals($phone->getSenderAreaCode(), 11);
        $this->assertEquals($phone->getSenderPhone(), 12341234);
    }
    
    public function phoneProvider()
    {
        return [
            [''],
            ['11'],
            ['1112341234'],
            ['11asdasdas'],
            ['MYPHONE'],
        ];
    }

}

class MyPhone implements PhoneInterface
{

    public function getSenderAreaCode()
    {
        
    }

    public function getSenderPhone()
    {
        
    }

    public function getValidator()
    {
        
    }

    public function hydrate(array $data = array())
    {
        
    }

    public function isValid()
    {
        
    }

    public function setSenderAreaCode($senderAreaCode)
    {
        
    }

    public function setSenderPhone($senderPhone)
    {
        
    }

    public function toArray()
    {
        
    }

}
