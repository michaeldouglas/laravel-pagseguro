<?php

namespace laravel\pagseguro\Remote\Url;

use laravel\pagseguro\Config\Config;

/**
 * URL Resolver Object
 *
 * @category   Remote
 * @package    Laravel\PagSeguro\Remote
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Resolver
{
    /**
     * Get Full API Url by key
     * @param string $key Key name
     * @return string
     */
    public function getByKey($key)
    {
        $useSandbox = Config::get('use-sandbox');
        $hosts = Config::get('host');
        $urls = Config::get('url');
        $hostKey = 'production';
        if ($useSandbox) {
            $hostKey = 'sandbox';
        }
        return $hosts[$hostKey] . $urls[$key];
    }
}
