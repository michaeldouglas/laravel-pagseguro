<?php

namespace laravel\pagseguro\Tests\Unit\Sender;

use laravel\pagseguro\Phone\Phone;
use laravel\pagseguro\Sender\Sender;
use PHPUnit\Framework\TestCase;

/**
 * Sender Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class SenderTest extends TestCase
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

    public function testSenderWithoutPhones()
    {
        $class = '\\laravel\\pagseguro\\Phone\\Phone';
        $data = [
            'email' => 'isaquesb@gmail.com',
            'name' => 'Isaque de Souza',
            'documents' => null,
            'phone' => [],
            'bornDate' => '1988-03-21',
        ];
        $sender = new Sender($data);
        $this->assertInstanceOf($class, $sender->getPhone());
    }

    public function testSenderWithoutPhonesKey()
    {
        $class = '\\laravel\\pagseguro\\Phone\\Phone';
        $data = [
            'email' => 'isaquesb@gmail.com',
            'name' => 'Isaque de Souza',
            'documents' => null,
            'bornDate' => '1988-03-21',
        ];
        $sender = new Sender($data);
        $this->assertInstanceOf($class, $sender->getPhone());
    }

    public function testSenderWithoutDocuments()
    {
        $phone = new Phone([]);
        $data = [
            'email' => 'isaquesb@gmail.com',
            'name' => 'Isaque de Souza',
            'documents' => null,
            'phone' => [],
            'bornDate' => '1988-03-21',
        ];
        $sender = new Sender($data);

        $this->assertEquals($data['email'], $sender->getEmail());
        $this->assertEquals($data['name'], $sender->getName());
        $this->assertEquals($data['documents'], $sender->getDocuments());
        $this->assertEquals($data['bornDate'], $sender->getBornDate());

    }
}
