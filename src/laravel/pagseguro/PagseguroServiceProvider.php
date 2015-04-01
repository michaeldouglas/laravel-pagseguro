<?php

namespace laravel\pagseguro;

use \laravel\pagseguro\Credentials\Credentials,
    \laravel\pagseguro\Request\PaymentRequest,
    \Illuminate\Support\ServiceProvider,
    \Config;

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

    const CREDENTIALS_CONFIG = 'packages/michael/laravelpagseguro/laravelpagseguro.credentials';

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
        $this->package('laravel/pagseguro');
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app['pagseguro'] = $this->app->share(function($app) {
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
        $config = Config::get(self::CREDENTIALS_CONFIG);
        $this->credentials = new Credentials($config['token'], $config['email']);
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
