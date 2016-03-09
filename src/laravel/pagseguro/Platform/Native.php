<?php

namespace laravel\pagseguro\Platform;

/**
 * Platform Native
 *
 * @category   Platform
 * @package    Laravel\PagSeguro
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-15
 *
 * @copyright  Laravel\PagSeguro
 */
class Native implements PlatformInterface
{

    /**
     * @return array
     */
    public function getUrlParameters()
    {
        return filter_input_array(INPUT_GET);
    }

    /**
     * @return boolean
     */
    public function hasPersonalConfig()
    {
        return false;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getConfigByKey($key)
    {
        unset($key);
        return [];
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setConfigByKey($key, $value)
    {
        unset($key, $value);
    }

    /**
     * @return void
     */
    public function abort()
    {
        $protocol = filter_input(INPUT_SERVER, 'SERVER_PROTOCOL');
        header($protocol . ' 500 Internal Server Error', true, 500);
    }

    /**
     * @return boolean
     */
    public function hasRouter()
    {
        return false;
    }

    /**
     * @param string $routeName
     * @return string
     */
    public function getUrlByRoute($routeName)
    {
        unset($routeName);
        return null;
    }
}
