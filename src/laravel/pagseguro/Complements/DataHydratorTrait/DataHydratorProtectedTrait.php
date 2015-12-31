<?php

namespace laravel\pagseguro\Complements\DataHydratorTrait;

/**
 * Data Protected Hydrator Trait
 * Only internal.
 *
 * @category   Components
 * @package    Laravel\PagSeguro\Complements
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
trait DataHydratorProtectedTrait
{

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    protected function hydrate(array $data = [])
    {
        return $this->doHydrate($data);
    }
}
