<?php

namespace laravel\pagseguro\Checkout;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Receiver\ReceiverInterface;

/**
 * Checkout Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface CheckoutInterface
{
    /**
     * Constructor
     * @param array $data Checkout data
     */
    public function __construct($data = []);

    /**
     * @return string
     */
    public function getCharset();

    /**
     * @return string
     */
    public function getCurrency();

    /**
     * @return ItemCollection
     */
    public function getItems();

    /**
     * @return MetadataCollection
     */
    public function getMetadata();

    /**
     * @return string
     */
    public function getNotificationURL();

    /**
     * @return ReceiverInterface
     */
    public function getReceiver();

    /**
     * @return string
     */
    public function getRedirectURL();

    /**
     * @return string
     */
    public function getReference();

    /**
     * @return SenderInterface
     */
    public function getSender();

    /**
     * @return ShippingInterface
     */
    public function getShipping();
}
