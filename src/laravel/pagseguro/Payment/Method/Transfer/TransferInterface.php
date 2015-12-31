<?php

namespace laravel\pagseguro\Payment\Method\Transfer;

/**
 * Payment Method Transfer Interface
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
interface TransferInterface
{
    const BRADESCO = 301;
    const ITAU = 302;
    const UNIBANCO = 303;
    const BANCO_DO_BRASIL = 304;
    const BANCO_REAL = 305;
    const BANRISUL = 306;
    const HSBC = 307;
}
