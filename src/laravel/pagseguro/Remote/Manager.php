<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Http\Request\Adapter\AdapterInterface;
use laravel\pagseguro\Config\Config;

/**
 * Remote Information Manager
 *
 * @category   Remote
 * @package    Laravel\PagSeguro\Remote
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Manager
{

    /**
     * @var AdapterInterface
     */
    private static $httpAdapter;

    /**
     * Set Http Adapter
     * @param AdapterInterface $adapter
     */
    public static function setHttpAdapter(AdapterInterface $adapter)
    {
        self::$httpAdapter = $adapter;
    }

    /**
     * Get Http Adapter
     * @return AdapterInterface
     */
    public static function getHttpAdapter()
    {
        $adapter = self::$httpAdapter;
        if (!$adapter) {
            $adapter = self::$httpAdapter = self::buildHttpAdapter();
        }
        return $adapter;
    }

    /**
     * Build Http Adapter by Application Config
     * @return AdapterInterface
     * @throws \RuntimeException
     */
    public static function buildHttpAdapter()
    {
        $http = Config::get('http');
        $adapterConfig = $http['adapter'];
        $adapter = null;
        if (is_array($adapterConfig)) {
            $adapter = self::adapterArrayFactory($adapterConfig);
        } elseif ($adapterConfig instanceof \Closure) {
            $adapter = $adapterConfig();
        }
        if (!($adapter instanceof AdapterInterface)) {
            throw new \RuntimeException('Invalid adapter object');
        }
        return $adapter;
    }

    /**
     * @param array $adapter
     * @return AdapterInterface
     */
    private static function adapterArrayFactory(array $adapter)
    {
        $type = reset($adapter);
        $options = end($adapter);
        if (!is_string($type) || !is_array($options)) {
            throw new \InvalidArgumentException('Invalid adapter config');
        }
        $namespace = '\\laravel\\pagseguro\\Http\\Request\\Adapter\\';
        $className = ucfirst($type) . 'Adapter';
        $class = $namespace . $className;
        if (!class_exists($class)) {
            throw new \InvalidArgumentException('Invalid adapter: ' . $type);
        }
        return new $class($options);
    }
}
