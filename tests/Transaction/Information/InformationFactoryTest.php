<?php

namespace Tests\Transaction\Information;

use laravel\pagseguro\Transaction\Information\InformationFactory;

/**
 * Status Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class InformationFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Response
     * @var string
     */
    protected $xmlResponse;

    /**
     * Set Up
     */
    public function setUp()
    {
        $file = new \SplFileObject(__DIR__ . '/simple-response.xml', 'r');
        $this->xmlResponse = $file->fread($file->getSize());
        unset($file);
    }

    public function testHasXml()
    {
        $this->assertNotEmpty($this->xmlResponse);
        $xml = simplexml_load_string($this->xmlResponse);
        $this->assertInstanceOf(\SimpleXMLElement::class, $xml);
    }
}
