<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Receiver\ReceiverInterface;
use laravel\pagseguro\Sender\SenderInterface;
use laravel\pagseguro\CreditCard\CreditCardInterface;
use laravel\pagseguro\Shipping\ShippingInterface;
use laravel\pagseguro\Remote\Checkout as RemoteCheckout;

/**
 * Simple Checkout Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class SimpleCheckout extends AbstractCheckout implements CheckoutInterface
{

    protected $paymentMode = 'default';

    public $paymentMethod;

    /**
     * Only BRL
     * @var string
     */
    protected $currency = 'BRL';

    /**
     * @var ItemCollection
     */
    protected $items;

    /**
     * @var CreditCardInterface
     */
    protected $creditCard;

    /**
     * @var SenderInterface
     */
    protected $sender;

    /**
     * @var ShippingInterface
     */
    protected $shipping;

    /**
     * @var ReceiverInterface
     */
    protected $receiver;

    /**
     * @return string
     */
    public function getPaymentMode()
    {
        return $this->paymentMode;
    }

    /**
     * @param string $paymentMode
     */
    public function setPaymentMode($paymentMode)
    {
        $this->paymentMode = $paymentMode;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return SenderInterface
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param SenderInterface $sender
     * @return SimpleCheckout
     */
    protected function setSender($sender)
    {
        if (!is_null($sender) && !($sender instanceof SenderInterface)) {
            throw new \InvalidArgumentException('Invalid Sender');
        }
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return CreditCardInterface
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCardInterface $creditCard
     * @return SimpleCheckout
     */
    public function setCreditCard($creditCard)
    {
        if (!is_null($creditCard) && !($creditCard instanceof CreditCardInterface)) {
            throw new \InvalidArgumentException('Invalid CreditCard');
        }
        $this->creditCard = $creditCard;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return SimpleCheckout
     */
    protected function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ItemCollection $items
     * @return SimpleCheckout
     */
    protected function setItems(ItemCollection $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return ReceiverInterface
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param ReceiverInterface $receiver
     * @return SimpleCheckout
     */
    public function setReceiver($receiver)
    {
        if (!is_null($receiver) && !($receiver instanceof ReceiverInterface)) {
            throw new \InvalidArgumentException('Invalid Receiver');
        }
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @return ShippingInterface
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param ShippingInterface $shipping
     * @return SimpleCheckout
     */
    protected function setShipping($shipping)
    {
        if (!is_null($shipping) && !($shipping instanceof ShippingInterface)) {
            throw new \InvalidArgumentException('Invalid Shipping');
        }
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * Send Checkout
     * @param CredentialsInterface $credentials
     * @return \laravel\pagseguro\Checkout\Information\Information
     */
    public function send(CredentialsInterface $credentials)
    {
        $remote = new RemoteCheckout();
        $data = $remote->send($this, $credentials);
        $factory = new Information\InformationFactory($data);
        return $factory->getInformation();
    }

    /**
     * Send Checkout Transparent
     * @param CredentialsInterface $credentials
     * @return \laravel\pagseguro\Checkout\Information\Information
     */
    public function transparent(CredentialsInterface $credentials)
    {
        $remote = new RemoteCheckout();
        //dd($this);
        $data = $remote->transparent($this, $credentials);
        return $data;
    }
}
