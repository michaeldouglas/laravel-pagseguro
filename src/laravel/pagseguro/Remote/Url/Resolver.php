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

    /**
     * Redirect URL
     * @return null
     */
    public function getRedirectURL()
    {
        return $this->getURLFromRouteConfigKey('redirect');
    }

    /**
     * Notification URL
     * @return null
     */
    public function getNotificationURL()
    {
        return $this->getURLFromRouteConfigKey('notification');
    }

    /**
     * Route Config URL
     * @param string $key
     * @return array
     */
    public function getRouteConfig($key)
    {
        $routes = Config::get('routes');
        if (array_key_exists($key, $routes)) {
            return $routes[$key];
        }
        return [];
    }

    /**
     * Route Config URL
     * @param string $key
     * @return array
     */
    private function getURLFromRouteConfigKey($key)
    {
        $url = null;
        $routeConfig = $this->getRouteConfig($key);
        $url = $this->getFixedURL($routeConfig);
        if (empty($url)) {
            $url = $this->getRouterURL($routeConfig);
        }
        return $url;
    }

    /**
     * Fixed URL
     * @param array $routeConfig [fixed: string]
     * @return string
     */
    private function getFixedURL($routeConfig)
    {
        $url = null;
        if (array_key_exists('fixed', $routeConfig)) {
            $url = $routeConfig['fixed'];
        }
        return empty($url) ? null: $url;
    }

    /**
     * Route URL
     * @param array $routeConfig [route-name: string]
     * @return string
     */
    private function getRouterURL($routeConfig)
    {
        $platform = Config::getPlatform();
        if (!$platform->hasRouter()) {
            throw new \RuntimeException('Undefined platform router');
        }
        if (!array_key_exists('route-name', $routeConfig)) {
            throw new \RuntimeException('Undefined key route-name');
        }
        $routeName = $routeConfig['route-name'];
        if (empty($routeName)) {
            return null;
        }
        return $platform->getUrlByRoute($routeName);
    }
}
