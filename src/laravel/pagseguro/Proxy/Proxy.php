<?php

namespace laravel\pagseguro\Proxy;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;

/**
 * Classe responsável por setar proxy a requisição
 *
 * @category   Proxy
 * @package    Laravel\PagSeguro\Proxy
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @author     Matheus Marabesi <matheus.marabesi@gmail.com>
 * @since      : 14/12/2015
 *
 * @copyright  Laravel\PagSeguro
 */

class Proxy {
    
    use DataHydratorTrait;
    
    protected $configProxy = [];
    protected $valuesProxy = [];
    private   $curl;
    private   $user;
    private   $password;
    private   $url;
    private   $port;
    private   $protocol;
    
    public function __construct($keyConfigProxy) 
    {
        $this->curl = curl_init();
        
        if($this->setArrayConfigProxy($keyConfigProxy)->getValuesConfig()->validateConfig()) {
            
            $this->hydrate($this->configProxy);

            curl_setopt($this->curl, CURLOPT_HTTPPROXYTUNNEL, 0);
            curl_setopt($this->curl, CURLOPT_PROXY, $this->getString());
        }
    }
    
    public function getString()
    {
        return sprintf('%s://%s:%s@%s:%s',
                $this->getProtocol(),
                $this->getUser(), 
                $this->getPassword(), 
                $this->getUrl(),
                $this->getPort()
            );
    }
    
    protected function setArrayConfigProxy($keyConfigProxy = 'proxy')
    {
        $this->configProxy = []; 
        
        if (class_exists('Config') && !is_null(Config($keyConfigProxy))) {//Verificação para config class do Laravel
            $this->configProxy = Config($keyConfigProxy); 
        }
        
        return $this;
    }
    
    public function getArrayConfigProxy()
    {
        return $this->configProxy;
    }
    
    protected function getValuesConfig()
    {
        $this->valuesProxy = array_values($this->configProxy);
        return $this;
    }
    
    public function validateConfig()
    {
        return (count(array_filter($this->valuesProxy)) > 0);
    }
    
    public function getCurl()
    {
        return $this->curl;
    }

    public function getValidationRules()
    {
        return new ValidationRules();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPort()
    {
        return $this->port;
    }
    
    public function getProtocol()
    {
        return $this->protocol;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }
    
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }
}