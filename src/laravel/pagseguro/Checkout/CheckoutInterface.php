<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Receiver\ReceiverInterface;
use laravel\pagseguro\Sender\SenderInterface;
use laravel\pagseguro\Shipping\ShippingInterface;

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
     * @return float
     */
    public function getExtraAmount();

    /**
     * @return ItemCollection
     */
    public function getItems();

    /**
     * @return float
     */
    public function getMaxUses();

    /**
     * @return float
     */
    public function getMaxAge();

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

    /**
     * Send Checkout
     * @param CredentialsInterface $credentials
     * @return array
     */
    public function send(CredentialsInterface $credentials);
}
