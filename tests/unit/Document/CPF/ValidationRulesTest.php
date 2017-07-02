<?php

namespace laravel\pagseguro\Tests\Unit\Sender\Document\CPF;

use laravel\pagseguro\Document\CPF\ValidationRules;

/**
 * Sender Document Validation Test
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
            $o = new ValidationRules();
            $this->rules = $o->getRules();
        }
        return $this->rules[$key];
    }

    /**
     * Email Data Provider
     * @return array
     */
    public function numberProvider()
    {
        return [
            ['', false],
            ['987654321', false],
            ['9876543210', false],
            ['87654321', false],
            ['8765432', false],
            ['phone123456789', false],
            ['10987654321', true],
            ['109876543210', false],
        ];
    }

    /**
     * @dataProvider numberProvider
     * @param mixed $value
     * @param boolean $expected
     * @return array
     */
    public function testNumber($value, $expected)
    {
        $rule = $this->getRule('number');
        $v = $this->validatorMake($rule, $value);
        $this->assertEquals($expected, $v->passes());
    }
}
