<?php

namespace laravel\pagseguro;

use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Config\Config;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use laravel\pagseguro\Facades\PagSeguroFacade;
use laravel\pagseguro\Platform\Laravel;

/**
 * Classe responsável por prover o serviço do Laravel PagSeguro ao Framework
 *
 * @category   ServiceProvider
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2015-01-02
 *
 * @copyright  Laravel\PagSeguro
 */
class ServiceProvider extends SupportServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * Bootstrap the application events.
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/laravelpagseguro.php' => config_path('laravelpagseguro.php')]);
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->bind('pagseguro', function () {
            $platform = new Laravel();
            $platform->registerNotificationCallback();
            Config::usePlatform($platform);
            $facade = new PagSeguroFacade();
            return $facade;
        });
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['pagseguro'];
    }
}
