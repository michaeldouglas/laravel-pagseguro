<?php

namespace laravel\pagseguro\Complements\DataHydratorTrait;

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
        return $this->doHydrate($data);
    }

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    protected function doHydrate(array $data = [])
    {
        $rules = $this->getHidratableVars();
        $defaultData = array_fill_keys(array_keys($rules), null);
        $currentData = $this->toArray();
        $testData = array_merge(
            $defaultData,
            $currentData,
            array_intersect_key($data, $defaultData)
        );
        $this->bindHydrate($testData);
        return $this;
    }

    /**
     * Data Hydrate
     * @param array $data
     * @return void
     */
    protected function bindHydrate(array $data = [])
    {
        $itr = new \ArrayIterator($data);
        while ($itr->valid()) {
            $key = $itr->key();
            $value = $itr->current();
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            } else {
                $this->{$key} = $value;
            }
            $itr->next();
        }
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
