<?php

namespace laravel\pagseguro\Tests\Unit\Parser;

use laravel\pagseguro\Parser\Xml;
use PHPUnit\Framework\TestCase;

/**
 * Xml Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class XmlTest extends TestCase
{

    protected function getXmlForParseTest()
    {
        $str = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<lps>
    <id>0580</id>
    <method>
        <code>101</code>
    </method>
    <items>
        <item>
            <id>0002</id>
            <description>Notebook</description>
        </item>
        <item>
            <id>0003</id>
            <description>Transação</description>
        </item>
    </items>
</lps>
XML;
        return $str;
    }

    public function testParse()
    {
        $str = $this->getXmlForParseTest();
        $xml = new Xml($str);
        $this->assertEquals([
            'id' => '0580',
            'method' => [
                'code' => '101'
            ],
            'items' => [
                'item' => [
                    [
                        'id' => '0002',
                        'description' => 'Notebook'
                    ],
                    [
                        'id' => '0003',
                        'description' => 'Transação'
                    ],
                ]
            ],
        ], $xml->toArray());
    }

    protected function getOneItemTest()
    {
        $str = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<lps>
    <items>
        <item>
            <id>0002</id>
            <description>Notebook</description>
        </item>
    </items>
</lps>
XML;
        return $str;
    }

    public function testOneItemParse()
    {
        $str = $this->getOneItemTest();
        $xml = new Xml($str);
        $this->assertEquals([
            'items' => [
                'item' => [
                    'id' => '0002',
                    'description' => 'Notebook'
                ]
            ],
        ], $xml->toArray());
    }
}
