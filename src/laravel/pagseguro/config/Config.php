<?php

namespace laravel\pagseguro\Config;

/**
 * Config Object
 *
 * @category   Config
 * @package    Laravel\PagSeguro\Http
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-10-28
 *
 * @copyright  Laravel\PagSeguro
 */
class Config
{

    protected static $data;

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        if (!preg_match('/[a-z-]/', $key)) {
            throw new \InvalidArgumentException('Invalid config key:' . $key);
        }
        $data = static::$data;
        if (class_exists('\Config')) {
            $data = \Config::get('laravelpagseguro');
        }
        if (is_null($data)) {
            $data = include( __DIR__ . '/application-config.php');
            static::$data = $data;
        }
        return $data[$key];
    }
}
