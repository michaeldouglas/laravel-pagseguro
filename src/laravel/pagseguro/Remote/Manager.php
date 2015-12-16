<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Http\Request\Adapter\AdapterInterface;

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
        return self::$httpAdapter;
    }
    
    public static function buildHttpAdapter()
    {
        
    }
}
