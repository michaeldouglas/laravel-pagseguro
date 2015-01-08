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
 * @since      2015-08-02
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
        $rules = $this->getValidationRules();
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
    protected function _hydrate(array $data = [])
    {
        $it = new \ArrayIterator($data);
        while($it->valid()) {
            $key = $it->key();
            $value = $it->current();
            $method = 'set' . ucfirst($key);
            if(method_exists($this, $method)) {
                $this->{$method}($value);
            } else {
                $this->{$key} = $value;
            }
            $it->next();
        }
    }

    /**
     * Get Validate Rules
     * @return array
     */
    public function getValidationRules()
    {
        if(property_exists($this, 'validationRules')) {
            return $this->validationRules;
        }
        return [];
    }

    /**
     * Get Validate Messages
     * @return array
     */
    public function getValidationMessages()
    {
        if(
            property_exists($this, 'validationMessages')
            && is_array($this->validationMessages)
        ) {
            return $this->validationMessages;
        }
        return [];
    }

    /**
     * Set Validate Messages
     * @param array $messages
     * @return object
     */
    public function setValidationMessages(array $messages)
    {
        if(
            property_exists($this, 'validationMessages')
            && is_array($this->validationMessages)
        ) {
            $this->validationMessages = $messages;
        }
        return $this;
    }

    /**
     * Test Valid Data
     * @return bool
     */
    public function isValid()
    {
        $rules = $this->getValidationRules();
        $currentData = $this->toArray();
        $messages = $this->getValidationMessages();
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
        $rules = $this->getValidationRules();
        $it = new \ArrayIterator(array_keys($rules));
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
