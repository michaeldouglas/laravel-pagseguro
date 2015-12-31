<?php

namespace laravel\pagseguro\Payment\Method\Billet;

/**
 * Payment Method BilletI Interface
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
interface BilletInterface
{
    const BRADESCO = 201;
    const SANTANDER = 202;
}
