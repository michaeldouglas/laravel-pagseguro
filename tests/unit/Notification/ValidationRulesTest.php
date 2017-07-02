<?php

namespace laravel\pagseguro\Tests\Unit\Notification;

use laravel\pagseguro\Notification\ValidationRules;

/**
 * Notification Validation Test
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
     * Code Data Provider
     * @return array
     */
    public function codeProvider()
    {
        $data = [
            ['012345678901234567890123456789012345678', true],
            ['0123ABC7890123456789012345678901234567D', true],
            ['0123456789012345678901234567890123456789', false],
            ['01234567890123456789012345678901234567', false],
        ];
        $data[] = $this->emptyRequired();
        return $data;
    }

    /**
     * @dataProvider codeProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testCode($value, $expected)
    {
        $rule = $this->getRule('notificationCode');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }

    /**
     * Type Data Provider
     * @return array
     */
    public function typeProvider()
    {
        return [
            ['', false],
            ['transaction', true],
            ['notification', false],
            ['request', false],
            [1, false],
        ];
    }

    /**
     * @dataProvider typeProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testType($value, $expected)
    {
        $rule = $this->getRule('notificationType');
        $validatorMake = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $validatorMake->passes());
    }
}
