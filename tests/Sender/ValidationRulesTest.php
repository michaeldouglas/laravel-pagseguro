<?php

namespace Tests\Sender;

use \laravel\pagseguro\Sender\ValidationRules;

/**
 * Sender Validation Test
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
    public function senderNameProvider()
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
            ['', true],
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
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
    }

    /**
     * @dataProvider senderNameProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testSenderName($value, $expected)
    {
        $rule = $this->getRule('senderName');
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
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
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
    }
}
