<?php

namespace laravel\pagseguro\Tests\Unit\Transaction;

use laravel\pagseguro\Transaction\Status\Status;

/**
 * Status Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class StatusTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \InvalidArgumentException Invalid
     */
    public function createProvider()
    {
        return [
            [0, 0, 'Iniciada'],
            [1, 1, 'Aguardando pagamento'],
            [2, 2, 'Em análise'],
            [3, 3, 'Paga'],
            [4, 4, 'Disponível'],
            [5, 5, 'Em disputa'],
            [6, 6, 'Devolvida'],
            [7, 7, 'Cancelada'],
            [8, 8, 'Chargeback'],
            [9, 9, 'Contestada']
        ];
    }

    /**
     * @dataProvider createProvider
     * @param mixed $value
     * @param int $expectedCode
     * @param string $expectedLabel
     * @return array
     */
    public function testCodeAndName($value, $expectedCode, $expectedLabel)
    {
        $status = new Status($value);
        $this->assertEquals($expectedCode, $status->getCode());
        $this->assertEquals($expectedLabel, $status->getName());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalid()
    {
        new Status('Cancelada');
    }

    public function testInitilized()
    {
        $status = new Status(Status::INITIALIZED);
        $this->assertFalse($status->finished());
    }

    public function testAwaiting()
    {
        $status = new Status(Status::AWAITING_PAYMENT);
        $this->assertFalse($status->canDispatch());
    }

    public function testReview()
    {
        $status = new Status(Status::REVIEW);
        $this->assertFalse($status->finished());
        $this->assertFalse($status->canceled());
    }

    public function testPaid()
    {
        $status = new Status(Status::PAID);
        $this->assertFalse($status->finished());
        $this->assertFalse($status->canceled());
        $this->assertTrue($status->canDispatch());
    }

    public function testCanceled()
    {
        $status = new Status(Status::CANCELED);
        $this->assertTrue($status->finished());
        $this->assertTrue($status->canceled());
        $this->assertFalse($status->canDispatch());
    }
}
