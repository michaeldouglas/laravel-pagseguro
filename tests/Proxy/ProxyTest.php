<?php

namespace Test\Proxy;

use laravel\pagseguro\Proxy\Proxy;

/**
 * @covers laravel\pagseguro\Proxy\Proxy
 */
class ProxyTest extends \PHPUnit_Framework_TestCase
{
    
    public function testShouldNotUseProxy()
    {
        $proxy = new Proxy('proxy');
        
        $this->assertEquals('://:@:', $proxy->getString());
    }
    
    public function testShouldUseProxy()
    {
        $proxy = new Proxy('proxy');
        $proxy->setUser('user');
        $proxy->setPassword('password');
        $proxy->setUrl('proxy');
        $proxy->setPort(3128);
        $proxy->setProtocol('http');
        
        $this->assertEquals('http://user:password@proxy:3128', $proxy->getString());
    }
}
