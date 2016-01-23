<?php

namespace laravel\pagseguro\Complements;

use \Validator;

/**
 * Validate Trait
 *
 * @category   Components
 * @package    Laravel\PagSeguro\Complements
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-08
 *
 * @copyright  Laravel\PagSeguro
 */
trait ValidateTrait
{

    /**
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * Get Hidratable Vars
     * @return array
     */
    protected function getHidratableVars()
    {
        return $this->getValidationRules()->getRules();
    }

    /**
     * @return ValidationRulesInterface
     */
    public abstract function getValidationRules();

    /**
     * Test Valid Data
     * @return bool
     */
    public function isValid()
    {
        $vRules = $this->getValidationRules();
        $rules = $vRules->getRules();
        $messages = $vRules->getMessages();
        $currentData = $this->export();
        $this->validator = Validator::make($currentData, $rules, $messages);
        return $this->validator->passes();
    }

    /**
     * Get Validator
     * Return only after hydrate
     * @return null|\Illuminate\Validation\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Cast Array
     * @return array
     */
    public function export()
    {
        if (method_exists($this, 'toArray')) {
            return $this->toArray();
        }
        $data = [];
        foreach (get_object_vars($this) as $key) {
            $data[$key] = $this->__get($key);
        }
        return $data;
    }
}
