<?php

namespace laravel\pagseguro\Tests\Unit\Item;

use laravel\pagseguro\Item\ValidationRules;

/**
 * Item Validation Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class ValidationRulesTest extends \laravel\pagseguro\Tests\Unit\ValidationRules
{

    /**
     * @param string $key
     * @return mixed
     */
    protected function getRule($key)
    {
        if(!$this->rules) {
            $validationRules = new ValidationRules();
            $this->rules = $validationRules->getRules();
        }
        return $this->rules[$key];
    }

    /**
     * Id Data Provider
     * @return array
     */
    public function idProvider()
    {
        return [
            ['', false],
            ['item01UD', true],
            ['$01', true],
            ['064', true],
            ['ITEM01', true],
            [str_repeat('ID DO ITEM', 10), true],
            [str_repeat('ID DO ITEM', 10) . '1', false],
        ];
    }

    /**
     * @dataProvider idProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testId($value, $expected)
    {
        $rule = $this->getRule('id');
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
    }

    /**
     * Description Data Provider
     * @return array
     */
    public function descriptionProvider()
    {
        return $this->idProvider();
    }

    /**
     * @dataProvider descriptionProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testDescription($value, $expected)
    {
        $rule = $this->getRule('description');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * Quantity Data Provider
     * @return array
     */
    public function quantityProvider()
    {
        return [
            ['', false],
            ['43', true],
            ['AAA', false],
            [1000, false],
            [-1, false],
            [0, false],
            [1, true],
        ];
    }

    /**
     * @dataProvider quantityProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testQuantity($value, $expected)
    {
        $rule = $this->getRule('quantity');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * @dataProvider numericRequiredUnsignedProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testAmount($value, $expected)
    {
        $rule = $this->getRule('amount');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * Weight Data Provider
     * @return array
     */
    public function weightProvider()
    {
        return [
            ['', true],
            ['43', true],
            ['230,45', false],
            ['40.78', false],
            ['AAA', false],
            [1000, true],
            [30001, false],
            [1, true],
            [25.6, false],
        ];
    }

    /**
     * @dataProvider weightProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testWeight($value, $expected)
    {
        $rule = $this->getRule('weight');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * Shipping Cost Data Provider
     * @return array
     */
    public function shippingCostProvider()
    {
        return [
            ['', true],
            ['43', true],
            ['230,45', false],
            ['40.78', true],
            ['AAA', false],
            [1000, true],
            [1, true],
            [0, true],
            [-1, false],
            [25.6, true],
        ];
    }

    /**
     * @dataProvider shippingCostProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testShippingCost($value, $expected)
    {
        $rule = $this->getRule('shippingCost');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * @dataProvider numericUnrequiredSignedProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testWidth($value, $expected)
    {
        $rule = $this->getRule('width');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * @dataProvider numericUnrequiredSignedProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testHeight($value, $expected)
    {
        $rule = $this->getRule('height');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * @dataProvider numericUnrequiredSignedProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testLength($value, $expected)
    {
        $rule = $this->getRule('length');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }
}
