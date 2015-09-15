<?php

namespace Tests\Sender;

use \laravel\pagseguro\Sender\Sender;

/**
 * Sender Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class SenderTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptySender()
    {
        $o = new Sender();
        $this->assertEquals([
            'email' => null,
            'senderName' => null,
            'documents' => null,
            'phone' => null,
            'bornDate' => null,
        ], $o->toArray());
    }

    public function testSenderWithoutPhonesAndDocuments()
    {
        $data = [
            'email' => 'isaquesb@gmail.com',
            'senderName' => 'Isaque de Souza',
            'documents' => null,
            'phone' => null,
            'bornDate' => '1988-03-21',
        ];
        $o = new Sender($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['email'], $o->getEmail());
        $this->assertEquals($data['senderName'], $o->getSenderName());
        $this->assertEquals($data['documents'], $o->getDocuments());
        $this->assertEquals($data['phone'], $o->getPhone());
        $this->assertEquals($data['bornDate'], $o->getBornDate());
    }
}
