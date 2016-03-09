<?php

namespace laravel\pagseguro\Checkout\Metadata;

/**
 * Metadata Info Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-03-09
 *
 * @copyright  Laravel\PagSeguro
 */
interface InfoInterface
{
    /**
     * InfoInterface constructor.
     * @param array $data
     */
    public function __construct($data = []);
}
