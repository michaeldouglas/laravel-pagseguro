<?php

namespace laravel\pagseguro\Payment\Method\Transfer;

use laravel\pagseguro\Payment\Method\MethodAbstract;

/**
 * Payment Method Transfer Object
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Transfer extends MethodAbstract implements TransferInterface
{

    /**
     * @var int
     */
    protected $type = self::TYPE_TRANSFER;

    /**
     * @var string
     */
    protected $typeName = 'Transferência eletrônica';

    /**
     * @var array
     */
    protected $names = [
        self::BRADESCO => 'Bradesco',
        self::ITAU => 'Itaú',
        self::UNIBANCO => 'Unibanco',
        self::BANCO_DO_BRASIL => 'Bando do Brasil',
        self::BANCO_REAL => 'Banco Real',
        self::BANRISUL => 'Branrisul',
        self::HSBC => 'HSBC'
    ];
}
