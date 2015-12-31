<?php

namespace laravel\pagseguro\Payment\Method;

/**
 * Payment Method Interface
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
interface MethodInterface
{
    const TYPE_CREDIT_CARD = 1;
    const TYPE_BILLET = 2;
    const TYPE_TRANSFER = 3;
    const TYPE_PS_CREDIT = 4;
    const TYPE_OI_PAGGO = 5;
    const TYPE_DEPOSIT_ACCOUNT = 6;

    /**
     * Get Type Code
     * @return int
     */
    public function getType();

    /**
     * Get Type Name
     * @return string
     */
    public function getTypeName();

    /**
     * Get Method Code
     * @return int
     */
    public function getCode();

    /**
     * Get Method Name
     * @return string
     */
    public function getName();

    /**
     * Get Full Name
     * @return string
     */
    public function getFullName();
}
