<?php

namespace laravel\pagseguro\Platform\Laravel5;

use laravel\pagseguro\Config\Config;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use laravel\pagseguro\Facades\PagSeguro as PagSeguroFacade;
use laravel\pagseguro\Platform\Laravel5;

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
     * Bootstrap the application events.
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../Config/application-config.php' => config_path('laravelpagseguro.php')]);
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->bind('pagseguro', function () {
            $platform = new Laravel5();
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
