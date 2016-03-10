<?php

namespace laravel\pagseguro\Platform;

/**
 * Platform Interface
 *
 * @category   Platform
 * @package    Laravel\PagSeguro
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-15
 *
 * @copyright  Laravel\PagSeguro
 */
interface PlatformInterface
{

    /**
     * @return array
     */
    public function getUrlParameters();

    /**
     * @return boolean
     */
    public function hasPersonalConfig();

    /**
     * @param string $key
     * @return array
     */
    public function getConfigByKey($key);

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setConfigByKey($key, $value);

    /**
     * @return void
     */
    public function abort();

    /**
     * @return boolean
     */
    public function hasRouter();

    /**
     * @param string $routeName
     * @return string
     */
    public function getUrlByRoute($routeName);
}
