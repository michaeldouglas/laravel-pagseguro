<?php

namespace Tests\Request;

/**
 * @covers \laravel\pagseguro\Request\Request
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    
    public function testShouldVerifyCurlExtension()
    {
        new \laravel\pagseguro\Request\Request();
    }
    
    public function testShouldReturnTimeSettedInTimeOut()
    {
        $request = new \laravel\pagseguro\Request\Request();
        $this->assertEquals(0, $request->getTimeout());
    }
    
    public function testShouldReturnCharsetUsed()
    {
        $request = new \laravel\pagseguro\Request\Request();
        $this->assertEquals('ISO-8859-1', $request->getCharset());
    }
    
    public function testShouldReturnCompleteCharsetHeader()
    {
        $request = new \laravel\pagseguro\Request\Request();
        $this->assertEquals(
            'Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1',
            $request->getStringCharset()
        );
    }
    
    public function testShouldReturnCheckoutUrl()
    {
        $request = new \laravel\pagseguro\Request\Request();
        $this->assertEquals(
            'https://ws.pagseguro.uol.com.br/v2/checkout',
            $request->getURL()
        );
    }
    
    public function testShouldReturnCurlOptionsMethod()
    {
        $request = new \laravel\pagseguro\Request\Request();
        $this->assertNull($request->getMethodOptions());
    }
}
