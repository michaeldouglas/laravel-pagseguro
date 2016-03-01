<?php

namespace laravel\pagseguro\Checkout\Facade;

use laravel\pagseguro\Address\Address;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Receiver\Receiver;
use laravel\pagseguro\Receiver\ReceiverInterface;
use laravel\pagseguro\Sender\Sender;
use laravel\pagseguro\Sender\SenderInterface;
use laravel\pagseguro\Shipping\Shipping;
use laravel\pagseguro\Shipping\ShippingInterface;

/**
 * Checkout Data Facade
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class DataFacade
{

    /**
     * @param array $data
     * @return array
     */
    public function ensureInstances(array $data)
    {
        if (array_key_exists('sender', $data)) {
            $data['sender'] = $this->ensureSenderInstance($data['sender']);
        }
        if (array_key_exists('receiver', $data)) {
            $data['receiver'] = $this->ensureReceiverInstance($data['receiver']);
        }
        if (array_key_exists('items', $data)) {
            $data['items'] = $this->ensureItemsInstance($data['items']);
        }
        if (array_key_exists('shipping', $data)) {
            $data['shipping'] = $this->ensureShippingInstance($data['shipping']);
        }
        return $data;
    }

    /**
     * @param array|SenderInterface $sender
     * @return SenderInterface
     */
    private function ensureSenderInstance($sender)
    {
        if ($sender instanceof SenderInterface) {
            return $sender;
        }
        if (!is_array($sender)) {
            throw new \InvalidArgumentException('Invalid sender data');
        }
        return new Sender($sender);
    }

    /**
     * @param array|ReceiverInterface $receiver
     * @return ReceiverInterface
     */
    private function ensureReceiverInstance($receiver)
    {
        if ($receiver instanceof ReceiverInterface) {
            return $receiver;
        }
        if (!is_array($receiver)) {
            throw new \InvalidArgumentException('Invalid receiver data');
        }
        return new Receiver($receiver);
    }

    /**
     * @param array|ItemCollection $items
     * @return ItemCollection
     */
    private function ensureItemsInstance($items)
    {
        if ($items instanceof ItemCollection) {
            return $items;
        }
        if (!is_array($items)) {
            throw new \InvalidArgumentException('Invalid items data');
        }
        return ItemCollection::factory($items);
    }

    /**
     * @param array|ShippingInterface $shipping
     * @return ShippingInterface
     */
    private function ensureShippingInstance($shipping)
    {
        if ($shipping instanceof ShippingInterface) {
            return $shipping;
        }
        if (!is_array($shipping)) {
            throw new \InvalidArgumentException('Invalid shipping data');
        }
        if (array_key_exists('address', $shipping)
            && is_array($shipping['address'])
        ) {
            $shipping['address'] = new Address($shipping['address']);
        }
        return new Shipping($shipping);
    }
}
