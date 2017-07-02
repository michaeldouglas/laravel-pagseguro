<?php

namespace laravel\pagseguro\Platform;

/**
 * Platform Laravel
 *
 * @category   Platform
 * @package    Laravel\PagSeguro
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-15
 *
 * @copyright  Laravel\PagSeguro
 */
class Laravel5 implements PlatformInterface
{

    /**
     * @return array
     */
    public function getUrlParameters()
    {
        return \Input::all();
    }

    /**
     * @return boolean
     */
    public function hasPersonalConfig()
    {
        return true;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getConfigByKey($key)
    {
        return \Config::get($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setConfigByKey($key, $value)
    {
        \Config::set($key, $value);
    }

    /**
     * @return void
     */
    public function abort()
    {
        \App::abort(500);
    }

    /**
     * @return boolean
     */
    public function hasRouter()
    {
        return true;
    }

    /**
     * @param string $routeName
     * @return string
     */
    public function getUrlByRoute($routeName)
    {
        return \URL::route($routeName);
    }
}
