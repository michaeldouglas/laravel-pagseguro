<?php

namespace laravel\pagseguro\Receiver;

/**
 * Receiver Interface
 *
 * @category   Receiver
 * @package    Laravel\PagSeguro\Receiver
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface ReceiverInterface
{
    /**
     * Constructor
     * @param array $data Checkout data
     */
    public function __construct($data = []);

    /**
     * @return string
     */
    public function getEmail();
}
