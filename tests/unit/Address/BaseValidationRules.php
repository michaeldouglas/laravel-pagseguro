<?php

namespace laravel\pagseguro\Tests\Unit\Address;

use laravel\pagseguro\Address\ValidationRules;

/**
 * Address Validation Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class BaseValidationRules extends \laravel\pagseguro\Tests\Unit\ValidationRules
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
     * @param string $strBase
     * @param int $size
     * @param bool $required
     * @return array
     */
    protected function getWithStrBaseWithRequired($strBase, $size = 10, $required = true)
    {
        $strBase = str_repeat($strBase, $size);
        return [
            $required ? $this->emptyRequired() : $this->emptyUnrequired(),
            [$strBase, true],
            [$strBase . 'A', false],
        ];
    }
}
