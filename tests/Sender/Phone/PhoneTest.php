<?php

namespace Tests\Sender\Phone;

use \laravel\pagseguro\Sender\Phone\Phone;

/**
 * Sender Phone Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class CPFTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyCPF()
    {
        $o = new Phone();
        $this->assertEquals([
            'senderAreaCode' => null,
            'senderPhone' => null,
        ], $o->toArray());
    }

    public function testCpf()
    {
        $data = [
            'senderAreaCode' => 11,
            'senderPhone' => 912345678,
        ];
        $o = new Phone($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['senderAreaCode'], $o->getSenderAreaCode());
        $this->assertEquals($data['senderPhone'], $o->getSenderPhone());
    }
}
