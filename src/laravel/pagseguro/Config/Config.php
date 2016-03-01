<?php

namespace laravel\pagseguro\Config;

use laravel\pagseguro\Platform\Native;
use laravel\pagseguro\Platform\PlatformInterface;

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

    /**
     * @var array
     */
    protected static $data;

    /**
     * @var PlatformInterface
     */
    protected static $platform;

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $platform = self::getPlatform();
        if (!preg_match('/[a-z-]/', $key)) {
            throw new \InvalidArgumentException('Invalid config key:' . $key);
        }
        $data = static::$data;
        if ($platform->hasPersonalConfig()) {
            $data = $platform->getConfigByKey('laravelpagseguro');
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
        $platform = self::getPlatform();
        $default = static::get($key);
        if ($default != $value) {
            static::$data[$key] = $value;
            if ($platform->hasPersonalConfig()) {
                $key = implode('.', (array) $key);
                \Config::set('laravelpagseguro.' . $key, $value);
            }
        }
    }

    /**
     * @return PlatformInterface
     */
    public static function getPlatform()
    {
        if (is_null(self::$platform)) {
            self::usePlatform(new Native());
        }
        return self::$platform;
    }

    /**
     * @param PlatformInterface $platformObject
     */
    public static function usePlatform(PlatformInterface $platformObject)
    {
        self::$platform = $platformObject;
    }
}
