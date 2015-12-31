<?php

namespace laravel\pagseguro\Payment\Method\DepositAccount;

use laravel\pagseguro\Payment\Method\MethodAbstract;

/**
 * Payment Method Deposit Account Object
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class DepositAccount extends MethodAbstract implements DepositAccountInterface
{

    /**
     * @var int
     */
    protected $type = self::TYPE_DEPOSIT_ACCOUNT;

    /**
     * @var string
     */
    protected $typeName = 'Depósito em conta';

    /**
     * @var array
     */
    protected $names = [
        self::BANCO_DO_BRASIL => 'Banco do Brasil',
        self::HSBC => 'HSBC'
    ];
}
