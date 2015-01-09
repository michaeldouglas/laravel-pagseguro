<?php

/**
 * Classe responsável por prover o serviço do Laravel PagSeguro ao FrameWork
 *
 * @category   ServiceProvider
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 02/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro;

use Illuminate\Support\ServiceProvider;

class PagseguroServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    protected $laravelPagSeguroCredential = null;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('laravel/pagseguro');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['pagseguro'] = $this->app->share(function($app) {
            $this->setCredentials();
            return new Payment\PaymentRequest($this->laravelPagSeguroCredential);
        });
    }
    
    /**
     * Set Credentials Gateway Payment
     *
     * @return array
     */
    public function setCredentials(){
        $this->laravelPagSeguroCredential = new Credentials\Credentials(\Config::get('pagseguro::pagseguro.credentials.token'), \Config::get('pagseguro::pagseguro.credentials.email'));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('pagseguro');
    }

}
