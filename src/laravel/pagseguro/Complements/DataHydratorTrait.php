<?php

namespace laravel\pagseguro\Complements;

use \Validator;

/**
 * Data Hydrator Trait
 *
 * @category   Components
 * @package    Laravel\PagSeguro\Complements
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-08
 *
 * @copyright  Laravel\PagSeguro
 */
trait DataHydratorTrait
{

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = [])
    {
        $rules = $this->getValidationRules()->getRules();
        $defaultData = array_fill_keys(array_keys($rules), null);
        $currentData = $this->toArray();
        $testData = array_merge(
            $defaultData,
            $currentData,
            array_intersect_key($data, $defaultData)
        );
        $this->_hydrate($testData);
        return $this;
    }

    /**
     * Data Hydrate
     * @param array $data
     * @return void
     */
    protected function _hydrate(array $data = [], $separator = 'set')
    {
        $it = new \ArrayIterator($data);
        while($it->valid()) {
            $key = $it->key();
            $value = $it->current();
            $method = $separator . ucfirst($key);
            if(method_exists($this, $method)) {
                $this->{$method}($value);
            } else {
                $this->{$key} = $value;
            }
            $it->next();
        }
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
        $currentData = $this->toArray();
        $this->validator = Validator::make($currentData, $rules, $messages);
        return $this->validator->passes();
    }

    /**
     * Get Validator
     * Return only after hydrate
     * @return null|Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Cast Array
     * @return array
     */
    public function toArray()
    {
        $cast = [];
        $rulesKeys = $this->getValidationRules()->getKeys();
        $it = new \ArrayIterator($rulesKeys);
        while($it->valid()) {
            $key = $it->current();
            $method = 'get' . ucfirst($key);
            if(method_exists($this, $method)) {
                $value = $this->{$method}();
            } else {
                $value = $this->{$key};
            }
            $cast[$key] = $value;
            $it->next();
        }
        return $cast;
    }

}
