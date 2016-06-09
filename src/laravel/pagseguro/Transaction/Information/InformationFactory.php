<?php

namespace laravel\pagseguro\Transaction\Information;

use laravel\pagseguro\Address\Address;
use laravel\pagseguro\Sender\Sender;
use laravel\pagseguro\Information\InformationAbstractFactory;
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
class InformationFactory extends InformationAbstractFactory
{

    /**
     * @var
     */
    private $normalizer;

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->normalizer = new InformationNormalizer();
        $normalized = $this->normalizer->transactionNormalized($data);
        parent::__construct($normalized);
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
            'itemCount',
            'installmentCount',
        ], null);
        $data = array_intersect_key($this->data, $map);
        $data['date'] = $this->getDate();
        $data['status'] = $this->getStatus();
        $data['lastEventDate'] = $this->getLastEventDate();
        $data['paymentMethod'] = $this->getPaymentMethod();
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
        $data = $this->data['paymentMethod'];
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
        return $this->getDateTimeObject($this->data['lastEventDate']);
    }

    /**
     * Get Date
     * @return \DateTimeInterface
     */
    public function getDate()
    {
        return $this->getDateTimeObject($this->data['date']);
    }

    /**
     * Get Sender
     * @return Sender
     */
    public function getSender()
    {
        $data = $this->getSenderDataNormalized();
        $sender = new Sender($data);
        return $sender;
    }

    /**
     * Key Case normalized
     * @return array
     */
    private function getSenderDataNormalized()
    {
        $data = $this->data['sender'];
        if (array_key_exists('phone', $data) && is_array($data['phone'])) {
            $data['phone'] = $this->normalizer->phoneNormalized($data['phone']);
        }
        if (array_key_exists('documents', $data)) {
            $data['documents'] = $this->normalizer->documentsNormalized($data['documents']);
        }
        return $data;
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
        $normalized = $this->normalizer->amountNormalized($data);
        $amounts = new Amounts($normalized);
        return $amounts;
    }

    /**
     * Get Items
     * @return ItemCollection
     */
    public function getItems()
    {
        $data = $this->data['items']['item'];
        if (1 == $this->data['itemCount']) {
            $data = [$this->data['items']['item']];
        }
        $items = ItemCollection::factory($data);
        return $items;
    }

    /**
     * Get Shipping
     * @return Shipping
     */
    public function getShipping()
    {
        $data = $this->normalizer->shippingNormalized($this->data['shipping']);
        $address = new Address($data['address']);
        $data['address'] = $address;
        $items = new Shipping($data);
        return $items;
    }
}
