<?php

namespace Tests\Shipping;

use \laravel\pagseguro\Shipping\ValidationRules;

/**
 * Shipping Validation Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class ValidationRulesTest extends \Tests\ValidationRules
{

    /**
     * @param string $key
     * @return mixed
     */
    protected function getRule($key)
    {
        if (!$this->rules) {
            $o = new ValidationRules();
            $this->rules = $o->getRules();
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
            ['12', true],
            ['BBT', false],
            [1010, false],
            [-1, false],
            [0, false],
            [1, true],
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
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
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
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
    }
}
