<?php

namespace Tests\Sender\Document\CPF;

use laravel\pagseguro\Document\CPF\CPF;

/**
 * Sender Document CPF Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 * @covers \laravel\pagseguro\Document\CPF\CPF
 */
class CPFTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyCPF()
    {
        $o = new CPF();
        $this->assertEquals([
            'number' => null,
        ], $o->toArray());
    }

    public function testCpf()
    {
        $data = [
            'number' => '10987654321',
        ];
        $o = new CPF($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['number'], $o->getNumber());
    }
}
