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
            $data = \Config::get('laravelpagseguro', $default);
        }
        if (is_null($data)) {
            $data = include(__DIR__ . '/application-config.php');
            static::$data = $data;
        }
        return array_key_exists($key, $data) ? $data[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        $default = static::get($key);
        if ($default != $value) {
            static::$data[$key] = $value;
            if (class_exists('\Config')) {
                $key = implode('.', (array) $key);
                \Config::set('laravelpagseguro.' . $key, $value);
            }
        }
    }
}
