<?php

namespace laravel\pagseguro\Information;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;

/**
 * Information Object
 *
 * @category   Information
 * @package    Laravel\PagSeguro\Information
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-10
 *
 * @copyright  Laravel\PagSeguro
 */
abstract class InformationAbstract
{

    use DataHydratorTrait, DataHydratorProtectedTrait {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data)) {
            $this->hydrate($data);
        }
    }
}
