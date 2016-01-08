<?php

namespace laravel\pagseguro\Transaction\Information;

use laravel\pagseguro\Address\Address;
use laravel\pagseguro\Sender\Sender;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Shipping\Shipping;
use laravel\pagseguro\Payment\Method\MethodInterface;
use laravel\pagseguro\Payment\Method\MethodFactory;
use laravel\pagseguro\Transaction\Status\StatusInterface;
use laravel\pagseguro\Transaction\Status\Status;

/**
 * Transaction Information Object Factory
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class InformationFactory
{

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Information
     */
    public function getInformation()
    {
        $map = array_fill_keys([
            'code',
            'reference',
            'type',
            'status',
            'itemcount',
            'installmentcount',
        ], null);
        $data = array_intersect_key($this->data, $map);
        $data['date'] = $this->getDate();
        $data['status'] = $this->getStatus();
        $data['lasteventdate'] = $this->getLastEventDate();
        $data['paymentmethod'] = $this->getPaymentMethod();
        $data['amounts'] = $this->getAmounts();
        $data['sender'] = $this->getSender();
        $data['shipping'] = $this->getShipping();
        $data['items'] = $this->getItems();
        return new Information($data);
    }

    /**
     * @return StatusInterface
     */
    public function getStatus()
    {
        $code = $this->data['status'];
        $status = new Status($code);
        return $status;
    }

    /**
     * @return MethodInterface
     */
    public function getPaymentMethod()
    {
        $data = $this->data['paymentmethod'];
        if (!array_key_exists('type', $data)
            || !array_key_exists('code', $data)
        ) {
            throw new \RuntimeException('Payment Method expected type and code');
        }
        $method = MethodFactory::factory($data['type'], $data['code']);
        return $method;
    }

    /**
     * Get Last Event Date
     * @return \DateTimeInterface
     */
    public function getLastEventDate()
    {
        return $this->getInDateTime($this->data['lasteventdate']);
    }

    /**
     * Get Date
     * @return \DateTimeInterface
     */
    public function getDate()
    {
        return $this->getInDateTime($this->data['date']);
    }

    /**
     * Get in \DateTime Object
     * @param string $stringDate
     * @return \DateTimeInterface
     */
    private function getInDateTime($stringDate)
    {
        $time = \str_replace('.000', '', $stringDate);
        return \DateTime::createFromFormat(\DateTime::W3C, $time);
    }

    /**
     * Get Sender
     * @return Sender
     */
    public function getSender()
    {
        $data = $this->data['sender'];
        $sender = new Sender($data);
        return $sender;
    }

    /**
     * Get Amounts
     * @return Amounts
     */
    public function getAmounts()
    {
        $map = array_fill_keys([
            'grossamount',
            'discountamount',
            'feeamount',
            'netamount',
            'extraamount',
        ], null);
        $data = array_intersect_key($this->data, $map);
        $amounts = new Amounts($data);
        return $amounts;
    }

    /**
     * Get Items
     * @return ItemCollection
     */
    public function getItems()
    {
        $data = $this->data['items']['item'];
        $items = ItemCollection::factory($data);
        return $items;
    }

    /**
     * Get Shipping
     * @return Shipping
     */
    public function getShipping()
    {
        $data = $this->data['shipping'];
        $address = new Address($data['address']);
        $data['address'] = $address;
        $items = new Shipping($data);
        return $items;
    }
}
