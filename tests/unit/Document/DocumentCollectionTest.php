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
        $o = DocumentCollection::factory([$item]);
        $this->assertInstanceOf('\laravel\pagseguro\Document\DocumentCollection', $o);
        $this->assertCount(1, $o);
        $this->assertEquals(new CPF($item), $o->offsetGet(0));
    }

    /**
     * Test With Cpf
     */
    public function testWithCpf()
    {
        $item = new CPF([
            'number' => '10987654321',
        ]);
        $o = DocumentCollection::factory([$item]);
        $this->assertInstanceOf('\laravel\pagseguro\Document\DocumentCollection', $o);
        $this->assertCount(1, $o);
        $this->assertEquals($item, $o->offsetGet(0));
    }

    /**
     * Test With Empty Data
     */
    public function testWithEmpty()
    {
        $o = DocumentCollection::factory();
        $this->assertInstanceOf('\laravel\pagseguro\Document\DocumentCollection', $o);
        $this->assertCount(0, $o);
    }
}
