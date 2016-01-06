<?php

namespace Tests\Transaction\Information;

use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Transaction\Transaction;
use laravel\pagseguro\Transaction\Information\Information;
use laravel\pagseguro\Http\Request\Adapter\AdapterInterface;
use laravel\pagseguro\Http\Response\Response;
use laravel\pagseguro\Remote\Manager;

/**
 * Information Factory Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class InformationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Response
     * @var string
     */
    protected $xmlResponse;

    /**
     * Information
     * @var string
     */
    protected $information;

    /**
     * SetUp
     */
    public function setUp()
    {
        $file = new \SplFileObject(__DIR__ . '/simple-response.xml', 'r');
        $this->xmlResponse = $file->fread($file->getSize());
        $adapter = $this->getMockBuilder(AdapterInterface::class)->getMock();
        $response = new Response();
        $response->setRawBody($this->xmlResponse)->setHttpStatus(200);
        $adapter->method('getResponse')->willReturn($response);
        $adapter->method('dispatch')->willReturn(true);
        Manager::setHttpAdapter($adapter);
        unset($file);
    }

    public function testHasXml()
    {
        $this->assertNotEmpty($this->xmlResponse);
        $xml = simplexml_load_string($this->xmlResponse);
        $this->assertInstanceOf(\SimpleXMLElement::class, $xml);
    }

    /**
     * @depends testHasXml
     */
    public function testFromResponseParsed()
    {
        $credentials = new Credentials('TOKEN', 'isaquesb@gmail.com');
        $transaction = new Transaction('9E884542-81B3-4419-9A75-BCC6FB495EF1', $credentials);
        $this->information = $transaction->getInformation();
        $this->assertInstanceOf(Information::class, $this->information);
    }
}
