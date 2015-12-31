<?php

namespace laravel\pagseguro;

use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Request\PaymentRequest;
use laravel\pagseguro\Config;
use \Illuminate\Support\ServiceProvider;

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
class PagseguroServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__ . '/Config/application-config.php' => config_path('laravelpagseguro.php')
        ]);
        //$this->package('laravel/pagseguro');
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->bind('pagseguro', function () {
            $this->loadCredentials();
            return new PaymentRequest($this->credentials);
        });
    }

    /**
     * Load Credentials From Config
     * @return void
     */
    public function loadCredentials()
    {
        $credentials = Config::get('credentials');
        $this->credentials = new Credentials(
            $credentials['token'],
            $credentials['email']
        );
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return array('pagseguro');
    }
}

