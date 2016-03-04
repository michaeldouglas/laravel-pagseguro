<?php

namespace laravel\pagseguro\Tests\Unit\Address;

/**
 * Address Validation Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class PrimaryInfoTest extends BaseValidationRules
{

    /**
     * Postal Code Data Provider
     * @return array
     */
    public function postalCodeProvider()
    {
        return [
            $this->emptyRequired(),
            ['asdasd', false],
            ['0640512', false],
            ['06405122', true],
            ['064051228', false],
        ];
    }

    /**
     * @dataProvider postalCodeProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testPostalCode($value, $expected)
    {
        $rule = $this->getRule('postalCode');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * Street Data Provider
     * @return array
     */
    public function streetProvider()
    {
        return $this->getWithStrBaseWithRequired('NOME RUA', 10);
    }

    /**
     * @dataProvider streetProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testStreet($value, $expected)
    {
        $rule = $this->getRule('street');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * Complement Data Provider
     * @return array
     */
    public function complementProvider()
    {
        $data = $this->getWithStrBaseWithRequired('COMP', 10, false);
        $data[] = ['Number 43', true];
        return $data;
    }

    /**
     * @dataProvider complementProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testComplement($value, $expected)
    {
        $rule = $this->getRule('complement');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }
}
