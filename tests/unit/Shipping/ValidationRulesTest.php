<?php

namespace laravel\pagseguro\Tests\Unit\Shipping;

use laravel\pagseguro\Shipping\ValidationRules;

/**
 * Shipping Validation Test
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
        if (!$this->rules) {
            $validationRules = new ValidationRules();
            $this->rules = $validationRules->getRules();
        }
        return $this->rules[$key];
    }

    /**
     * Type Data Provider
     * @return array
     */
    public function typeProvider()
    {
        return [
            ['', false],
            ['12', false],
            ['BBT', false],
            [1010, false],
            [-1, false],
            [0, false],
            [1, true],
            [2, true],
            [3, true],
        ];
    }

    /**
     * @dataProvider numericRequiredUnsignedProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testCost($value, $expected)
    {
        $rule = $this->getRule('cost');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * @dataProvider typeProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testType($value, $expected)
    {
        $rule = $this->getRule('type');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }
}
