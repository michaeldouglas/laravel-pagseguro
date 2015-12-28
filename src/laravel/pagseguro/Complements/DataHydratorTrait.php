<?php

namespace laravel\pagseguro\Complements;

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
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = [])
    {
        $rules = $this->getHidratableVars();
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
     * Get Hidratable Vars
     * @return array
     */
    protected function getHidratableVars()
    {
        return get_object_vars($this);
    }

    /**
     * Data Hydrate
     * @param array $data
     * @return void
     */
    protected function _hydrate(array $data = [])
    {
        $it = new \ArrayIterator($data);
        while ($it->valid()) {
            $key = $it->key();
            $value = $it->current();
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            } else {
                $this->{$key} = $value;
            }
            $it->next();
        }
    }

    /**
     * Cast Array
     * @return array
     */
    public function toArray()
    {
        $cast = [];
        $rulesKeys = array_keys($this->getHidratableVars());
        $it = new \ArrayIterator($rulesKeys);
        while ($it->valid()) {
            $key = $it->current();
            $method = 'get' . ucfirst($key);
            if (method_exists($this, $method)) {
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
