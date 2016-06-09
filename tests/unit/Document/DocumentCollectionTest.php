<?php

namespace laravel\pagseguro\Tests\Unit\Sender\Document;

use laravel\pagseguro\Document\CPF\CPF;
use laravel\pagseguro\Document\DocumentCollection;

/**
 * Document Collection Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class DocumentCollectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test With Integer
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testWithInteger()
    {
        DocumentCollection::factory([1]);
    }

    /**
     * Test With String
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testWithString()
    {
        DocumentCollection::factory(['10987654321']);
    }

    /**
     * Test With Object
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testWithObject()
    {
        $item = new \stdClass();
        DocumentCollection::factory([$item]);
    }

    /**
     * Test With Array
     */
    public function testWithArray()
    {
        $item = [
            'number' => '10987654321',
            'type' => 'CPF'
        ];
        $collection = DocumentCollection::factory([$item]);
        $this->assertInstanceOf('\laravel\pagseguro\Document\DocumentCollection', $collection);
        $this->assertCount(1, $collection);
        $this->assertEquals(new CPF($item), $collection->offsetGet(0));
    }

    /**
     * Test With Cpf
     */
    public function testWithCpf()
    {
        $item = new CPF([
            'number' => '10987654321',
        ]);
        $collection = DocumentCollection::factory([$item]);
        $this->assertInstanceOf('\laravel\pagseguro\Document\DocumentCollection', $collection);
        $this->assertCount(1, $collection);
        $this->assertEquals($item, $collection->offsetGet(0));
    }

    /**
     * Test With Empty Data
     */
    public function testWithEmpty()
    {
        $collection = DocumentCollection::factory();
        $this->assertInstanceOf('\laravel\pagseguro\Document\DocumentCollection', $collection);
        $this->assertCount(0, $collection);
    }

    /**
     * Test With Empty Data
     * @expectedException \InvalidArgumentException
     */
    public function testDocumentFactoryEmptyNumber()
    {
        DocumentCollection::documentFactory([
            'number' => null,
            'type' => 'CPF'
        ]);
    }
}
