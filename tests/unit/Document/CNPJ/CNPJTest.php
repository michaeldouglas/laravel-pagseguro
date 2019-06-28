<?php

namespace laravel\pagseguro\Tests\Unit\Sender\Document\CNPJ;

use laravel\pagseguro\Document\CNPJ\CNPJ;

/**
 * Sender Document CNPJ Test
 * @author José Tobias de Freitas Neto <jtfnetoo@gmail.com>
 */
class CNPJTest extends \PHPUnit\Framework\TestCase
{

    public function testEmptyCNPJ()
    {
        $cnpj = new CNPJ();
        $this->assertEquals([
            'number' => null,
        ], $cnpj->toArray());
    }

    public function testCnpj()
    {
        $data = [
            'number' => '51815418000198',
        ];
        $cnpj = new CNPJ($data);
        $this->assertEquals($data, $cnpj->toArray());
        $this->assertEquals($data['number'], $cnpj->getNumber());
    }
}
