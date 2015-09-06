<?php

use \laravel\pagseguro\Address\ValidationRules;

/**
 * Address Validation Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class ValidationRulesTest extends PHPUnit_Framework_TestCase
{

    protected $rules;

    protected function getRule($key)
    {
        if(!$this->rules) {
            $o = new ValidationRules();
            $this->rules = $o->getRules();
        }
        return $this->rules[$key];
    }

    protected function validatorMake($rule, $value)
    {
        return \Validator::make(['field' => $value], ['field' => $rule]);
    }

    public function postalCodeProvider()
    {
        return [
            ['06405122', true]
        ];
    }

    /**
     * @dataProvider postalCodeProvider
     * @return array
     */
    public function testPostalCode($value, $expected)
    {
        $rule = $this->getRule('postalCode');
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
    }

}
