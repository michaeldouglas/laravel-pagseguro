<?php

namespace laravel\pagseguro\Transaction\Information;

use laravel\pagseguro\Information\InformationAbstract;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Sender\SenderInterface;
use laravel\pagseguro\Shipping\ShippingInterface;
use laravel\pagseguro\Payment\Method\MethodInterface as PaymentMethod;

/**
 * Transaction Information Object
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Information extends InformationAbstract
{

    /**
     * Transaction Code
     * @var string
     */
    protected $code;

    /**
     * Date
     * @var \DateTime
     */
    protected $date;

    /**
     * Reference
     * @var string
     */
    protected $reference;

    /**
     * Type
     * @var int
     */
    protected $type;

    /**
     * Status
     * @var int
     */
    protected $status;

    /**
     * Last Event Date
     * @var \DateTime
     */
    protected $lastEventDate;

    /**
     * Payment Method
     * @var PaymentMethod
     */
    protected $paymentMethod;

    /**
     * @var Amounts
     */
    protected $amounts;

    /**
     * Installment Amount
     * @var int
     */
    protected $installmentCount;

    /**
     * Item Count
     * @var int
     */
    protected $itemCount;

    /**
     * Items
     * @var ItemCollection
     */
    protected $items;

    /**
     * Sender
     * @var SenderInterface
     */
    protected $sender;

    /**
     * Shipping
     * @var ShippingInterface
     */
    protected $shipping;

    /**
     * Transaction Code
     * @param string $code
     * @throws \InvalidArgumentException
     */
    protected function setCode($code)
    {
        if (!\is_string($code)) {
            throw new \InvalidArgumentException('Invalid transaction code');
        }
        $this->code = $code;
    }

    /**
     * Get Code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get Date
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get Reference
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get Type
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get Status
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get Last event date
     * @return \DateTime
     */
    public function getLastEventDate()
    {
        return $this->lastEventDate;
    }

    /**
     * Get Payment Method
     * @return PaymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Get Amounts
     * @return Amounts
     */
    public function getAmounts()
    {
        return $this->amounts;
    }

    /**
     * Get Installment Count
     * @return int
     */
    public function getInstallmentCount()
    {
        return $this->installmentCount;
    }

    /**
     * Get Item Count
     * @return int
     */
    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * Get Items
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get Sender
     * @return SenderInterface
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Get Shipping
     * @return ShippingInterface
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param \DateTime $date
     * @return Information
     */
    protected function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param string $reference
     * @return Information
     */
    protected function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param int $type
     * @return Information
     */
    protected function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $status
     * @return Information
     */
    protected function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param \DateTime $lastEventDate
     * @return Information
     */
    protected function setLastEventDate($lastEventDate)
    {
        $this->lastEventDate = $lastEventDate;
        return $this;
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return Information
     */
    protected function setPaymentMethod(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @param Amounts $amounts
     * @return Information
     */
    protected function setAmounts(Amounts $amounts)
    {
        $this->amounts = $amounts;
        return $this;
    }

    /**
     * @param int $installmentCount
     * @return Information
     */
    protected function setInstallmentCount($installmentCount)
    {
        $this->installmentCount = $installmentCount;
        return $this;
    }

    /**
     * @param int $itemCount
     * @return Information
     */
    protected function setItemCount($itemCount)
    {
        $this->itemCount = $itemCount;
        return $this;
    }

    /**
     * @param ItemCollection $items
     * @return Information
     */
    protected function setItems(ItemCollection $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param SenderInterface $sender
     * @return Information
     */
    protected function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @param ShippingInterface $shipping
     * @return Information
     */
    protected function setShipping(ShippingInterface $shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }
}
