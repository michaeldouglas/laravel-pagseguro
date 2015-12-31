<?php

namespace laravel\pagseguro\Complements\DataHydratorTrait;

/**
 * Data Hydrator Constructor Trait
 *
 * @category   Components
 * @package    Laravel\PagSeguro\Complements
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
trait DataHydratorConstructorTrait
{
    /**
     * Hydrate Constructor
     * @param array $keys
     * @param array $args
     */
    protected function hydrateMagic(array $keys, array $args)
    {
        $argNum = count($args);
        $first = current($args);
        $assoc = is_array($first) && 1 === $argNum && !is_numeric(key($first));
        $data = [];
        if (!$assoc && count($args) === count($keys)) {
            $data = array_combine($keys, $args);
        } elseif (!$assoc) {
            foreach ($args as $keyNum => $value) {
                $key = $keys[$keyNum];
                $data[$key] = $value;
            }
        } else {
            $data = $first;
        }
        if (count($data)) {
            $this->hydrate($data);
        }
    }
}
