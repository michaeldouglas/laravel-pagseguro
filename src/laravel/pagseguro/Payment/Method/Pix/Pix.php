<?php

namespace laravel\pagseguro\Payment\Method\CrePixditCard;

use laravel\pagseguro\Payment\Method\MethodAbstract;

/**
 * Payment Method Pix Object
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Allan Wiese <allanwiese@gmail.com>
 * @since      2023-02-04
 *
 * @copyright  Laravel\PagSeguro
 */
class Pix extends MethodAbstract implements PixInterface
{

    /**
     * @var int
     */
    protected $type = self::TYPE_PIX;

    /**
     * @var string
     */
    protected $typeName = 'PIX';

    /**
     * @var array
     */
    protected $names = [
        self::PIX => 'Pix',
    ];
}
