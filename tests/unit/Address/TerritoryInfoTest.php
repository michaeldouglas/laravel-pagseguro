<?php

namespace laravel\pagseguro\Tests\Unit\Address;

/**
 * Address Validation Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class TerritoryInfoTest extends BaseValidationRules
{

    /**
     * District Data Provider
     * @return array
     */
    public function districtProvider()
    {
        return $this->getWithStrBaseWithRequired('DISTCT', 10);
    }

    /**
     * @dataProvider districtProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testDistrict($value, $expected)
    {
        $rule = $this->getRule('district');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * City Data Provider
     * @return array
     */
    public function cityProvider()
    {
        return [
            $this->emptyRequired(),
            ['CITY NAME', true],
            ['C', false],
            [str_repeat('CITYNM', 10), true],
            [str_repeat('CITYNM', 10) . 'A', false],
        ];
    }

    /**
     * @dataProvider cityProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testCity($value, $expected)
    {
        $rule = $this->getRule('city');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * State Data Provider
     * @return array
     */
    public function stateProvider()
    {
        return [
            $this->emptyRequired(),
            ['SP', true],
            ['STATE', false],
        ];
    }

    /**
     * @dataProvider stateProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testState($value, $expected)
    {
        $rule = $this->getRule('state');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * Country Data Provider
     * @return array
     */
    public function countryProvider()
    {
        return [
            $this->emptyRequired(),
            ['BRA', true],
            ['ARG', false],
        ];
    }

    /**
     * @dataProvider countryProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testCountry($value, $expected)
    {
        $rule = $this->getRule('country');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }
}
