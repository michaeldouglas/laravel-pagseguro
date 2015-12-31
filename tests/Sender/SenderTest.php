<?php

namespace Tests\Sender;

use laravel\pagseguro\Sender\Sender;

/**
 * Sender Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 * @covers \laravel\pagseguro\Sender\Sender
 */
class SenderTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptySender()
    {
        $o = new Sender();
        $this->assertEquals([
            'email' => null,
            'name' => null,
            'documents' => null,
            'phone' => null,
            'bornDate' => null,
        ], $o->toArray());
    }

    public function testSenderWithoutPhonesAndDocuments()
    {
        $data = [
            'email' => 'isaquesb@gmail.com',
            'name' => 'Isaque de Souza',
            'documents' => null,
            'phone' => null,
            'bornDate' => '1988-03-21',
        ];
        $o = new Sender($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['email'], $o->getEmail());
        $this->assertEquals($data['name'], $o->getName());
        $this->assertEquals($data['documents'], $o->getDocuments());
        $this->assertEquals($data['phone'], $o->getPhone());
        $this->assertEquals($data['bornDate'], $o->getBornDate());
    }
}
