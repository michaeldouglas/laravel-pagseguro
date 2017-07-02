<?php

namespace laravel\pagseguro\Platform\Laravel5;

use Illuminate\Support\Facades\Facade;

/**
 * PagSeguro Laravel Facade
 * @author  Michael Douglas <michaeldouglas010790@gmail.com>
 */
class PagSeguro extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pagseguro';
    }
}
