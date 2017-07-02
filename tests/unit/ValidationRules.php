<?php

namespace laravel\pagseguro\Tests\Unit;

/**
 * ValidationRules Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class ValidationRules extends \PHPUnit_Framework_TestCase
{

    /**
     * @var array
     */
    protected $rules;

    /**
     * @param string $rule
     * @param mixed $value
     * @return \Illuminate\Validation\Validator
     */
    protected function validatorMake($rule, $value)
    {
        return new \Illuminate\Validation\Validator(
            new \Symfony\Component\Translation\Translator('pt_BR'),
            ['field' => $value],
            ['field' => $rule]
        );
    }

    /**
     * Numeric Unrequired Unsigned Data Provider
     * @return array
     */
    public function numericUnrequiredUnsignedProvider()
    {
        return [
            ['', true],
            [-1, false],
            ['43', true],
            ['230,45', false],
            ['40.78', true],
            ['AAA', false],
            [1000, true],
            [1, true],
            [0, true],
            [25.6, true],
        ];
    }

    /**
     * Numeric Required Signed Data Provider
     * @return array
     */
    public function numericUnrequiredSignedProvider()
    {
        $data = $this->numericUnrequiredUnsignedProvider();
        $data[1] = [-1, true];
        return $data;
    }

    /**
     * Numeric Required Unsigned Data Provider
     * @return array
     */
    public function numericRequiredUnsignedProvider()
    {
        $data = $this->numericUnrequiredUnsignedProvider();
        $data[0] = ['', false];
        return $data;
    }

    /**
     * Numeric Required Signed Data Provider
     * @return array
     */
    public function numericRequiredSignedProvider()
    {
        $data = $this->numericRequiredUnsignedProvider();
        $data[1] = [-1, true];
        return $data;
    }

    /**
     * @return array
     */
    protected function emptyRequired()
    {
        return ['', false];
    }

    /**
     * @return array
     */
    protected function emptyUnrequired()
    {
        return ['', true];
    }
}
