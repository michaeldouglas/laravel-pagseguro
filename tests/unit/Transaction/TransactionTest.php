<?php

namespace laravel\pagseguro\Tests\Unit\Transaction;

use laravel\pagseguro\Transaction\Transaction;
use laravel\pagseguro\Credentials\Credentials;

/**
 * Transaction Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class TransactionTest extends \PHPUnit_Framework_TestCase
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
