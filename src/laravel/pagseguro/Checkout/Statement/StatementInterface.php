<?php

namespace laravel\pagseguro\Checkout\Statement;

use laravel\pagseguro\Checkout\CheckoutInterface;
use laravel\pagseguro\Http\Request\RequestInterface;

/**
 * Checkout Statement Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkoutr
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface StatementInterface
{

    /**
     * Constructor
     * @param CheckoutInterface $checkout
     */
    public function __construct(CheckoutInterface $checkout);

    /**
     * @param RequestInterface $request
     * @return void
     */
    public function prepare(RequestInterface $request);
}
