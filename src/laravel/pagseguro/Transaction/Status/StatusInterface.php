<?php

namespace laravel\pagseguro\Transaction\Status;

/**
 * Transaction Status Interface
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-09-15
 *
 * @copyright  Laravel\PagSeguro
 */
interface StatusInterface
{

    const INITIALIZED = 0;
    const AWAITING_PAYMENT = 1;
    const REVIEW = 2;
    const PAID = 3;
    const AVAIBLE = 4;
    const DISPUTE = 5;
    const RETURNED = 6;
    const CANCELED = 7;
    const SELLER_CHARGEBACK = 8;
    const CONTESTATION = 9;

    /**
     * @return int
     */
    public function getCode();

    /**
     * @return string
     */
    public function getName();

    /**
     * Se Pode liberar o produto/ serviço para o cliente
     * You can release the product / service to the customer
     */
    public function canDispatch();

    /**
     * Se o dinheiro já esta disponível
     * If the money is already available
     */
    public function isAvaible();

    /**
     * Se a transação foi cancelada
     * If the transaction is canceled
     */
    public function canceled();

    /**
     * Se a transação foi encerrada
     * If the transaction is finished
     */
    public function finished();
}
