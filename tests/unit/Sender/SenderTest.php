<?php

namespace laravel\pagseguro\Tests\Unit\Sender;

use laravel\pagseguro\Sender\Sender;

/**
 * Sender Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class SenderTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptySender()
    {
        $sender = new Sender();
        $this->assertEquals([
            'email' => null,
            'name' => null,
            'documents' => null,
            'phone' => null,
            'bornDate' => null,
        ], $sender->toArray());
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
        $sender = new Sender($data);
        $this->assertEquals($data, $sender->toArray());
        $this->assertEquals($data['email'], $sender->getEmail());
        $this->assertEquals($data['name'], $sender->getName());
        $this->assertEquals($data['documents'], $sender->getDocuments());
        $this->assertEquals($data['phone'], $sender->getPhone());
        $this->assertEquals($data['bornDate'], $sender->getBornDate());
    }
}
