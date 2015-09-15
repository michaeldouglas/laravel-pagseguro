<?php

use laravel\pagseguro\Sender\Phone\Phone;
use laravel\pagseguro\Sender\Phone\PhoneInterface;

/**
 * @cover laravel\pagseguro\Sender\Phone\Phone
 */
class PhoneTest extends PHPUnit_Framework_TestCase
{
    
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
                'laravel\pagseguro\Sender\Phone\Phone', 
                new Phone()
        );
        
        $this->assertInstanceOf(
                'laravel\pagseguro\Sender\Phone\Phone', 
                new Phone([123456])
        );
    }
    
    public function testShouldAnewReturnValidationRulesObject()
    {
        $phone = new Phone();
        $validationRules = $phone->getValidationRules();
        
        $this->assertNotSame($phone->getValidationRules(), $validationRules);
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