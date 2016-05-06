<?php

namespace laravel\pagseguro\Tests\Unit\Sender;

use laravel\pagseguro\Sender\ValidationRules;

/**
 * Sender Validation Test
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
     * Email Data Provider
     * @return array
     */
    public function emailProvider()
    {
        return [
            ['', false],
            ['isaquesb@gmail.com', true],
            ['michaeldouglas010790@gmail.com', true],
            [1, false],
            ['email@', false],
        ];
    }

    /**
     * Sender Name Data Provider
     * @return array
     */
    public function nameProvider()
    {
        return [
            ['', false],
            ['Isaque de Souza', true],
            ['Michael Douglas', true],
            [1, false],
            ['I', false],
            ['IS', true],
            [str_repeat('PAGUE', 10), true],
            [str_repeat('PAGUE', 10) . 'S', false],
        ];
    }

    /**
     * Born Date Data Provider
     * @return array
     */
    public function bornDateProvider()
    {
        return [
            ['21/03/1988', false],
            ['1988-03-21', true],
            [1, false],
        ];
    }

    /**
     * @dataProvider emailProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testEmail($value, $expected)
    {
        $rule = $this->getRule('email');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * @dataProvider nameProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testName($value, $expected)
    {
        $rule = $this->getRule('name');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * @dataProvider bornDateProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testBornDate($value, $expected)
    {
        $rule = $this->getRule('bornDate');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }
}
