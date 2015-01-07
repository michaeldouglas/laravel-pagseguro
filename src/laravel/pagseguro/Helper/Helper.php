<?php

namespace laravel\pagseguro\Helper;

/**
 * Helper with utils methods
 *
 * @category   Credentials
 * @package    Laravel\PagSeguro
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      : 02/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */
class Helper
{

    /**
     * Use self::getValueOrDefault
     * @deprecated
     * @param array $item
     * @param string $key
     * @return mixed
     */
    public static function setVerifyKeyItem($item, $key)
    {
        return self::getValueOrDefault($item, $key, null);
    }

    /**
     * Get value by key or return default
     * @param array|object $object Object to extract
     * @param string $key Key name
     * @param mixed $default Default Value
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public static function getValueOrDefault($object, $key, $default = null)
    {
        if(!is_string($key) || empty($key)) {
            throw new \InvalidArgumentException ('Invalid key to extract');
        }
        if(is_object($object) && isset($object->{$key})) {
            return $object->{$key};
        } elseif(is_array($object) && array_key_exists($key, $object)) {
            return $object[$key];
        }
        return $default;
    }

}
