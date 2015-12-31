<?php

namespace laravel\pagseguro\Payment\Method\Billet;

use laravel\pagseguro\Payment\Method\MethodAbstract;

/**
 * Payment Method Billet Object
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Billet extends MethodAbstract implements BilletInterface
{

    /**
     * @var int
     */
    protected $type = self::TYPE_BILLET;

    /**
     * @var string
     */
    protected $typeName = 'Boleto';

    /**
     * @var array
     */
    protected $names = [
        self::BRADESCO => 'Bradesco',
        self::SANTANDER => 'Santander'
    ];
}
