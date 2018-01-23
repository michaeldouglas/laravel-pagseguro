<?php

namespace laravel\pagseguro\Tests\Unit\Transaction;

use laravel\pagseguro\Transaction\Transaction;
use laravel\pagseguro\Credentials\Credentials;
use PHPUnit\Framework\TestCase;

/**
 * Transaction Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class TransactionTest extends TestCase
{

    /**
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testWithNumericTransactionCode()
    {
        $credential = new Credentials('ASD', 'isaquesb@gmail.com');
        new Transaction(123456, $credential, false);
    }
}
