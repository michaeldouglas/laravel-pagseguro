<?php

namespace laravel\pagseguro\Facades;

use laravel\pagseguro\Plans\Plans;
use laravel\pagseguro\Plans\PlansInterface;
use laravel\pagseguro\Plans\Facade\DataFacade;

/**
 * Plans Facade Object
 *
 * @category   Plans
 * @package    Laravel\PagSeguro\Plan
 *
 * @author     Michael Araujo <michaeldouglas010790@gmail.com>
 * @since      2019-08-28
 *
 * @copyright  Laravel\PagSeguro
 */
class Plan
{
    /**
     * @param array $data
     * @return PlansInterface
     */
    public function createFromArray(array $data)
    {
        $this->checkArray($data);

        $dataFacade = new DataFacade();
        $PlansData = $dataFacade->ensureInstances($data);

        $plan = new Plans($PlansData);

        return $plan;
    }

    private function checkArray(array $data)
    {
        if(count($data) == 0)
            throw new \InvalidArgumentException('Parameter array plan size 0. Please check your array.');
    }
}