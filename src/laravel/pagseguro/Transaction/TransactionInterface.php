<?php

namespace laravel\pagseguro\Transaction;

/**
 * Transaction Interface
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-09-15
 *
 * @copyright  Laravel\PagSeguro
 */
interface TransactionInterface
{
    /**
     * Get Code
     * @return string
     */
    public function getCode();

    /**
     * Check transaction status
     * @return bool
     */
    public function check();

    /**
     * Get Transaction Info
     * @return Information\Information
     */
    public function getInformation();
}
