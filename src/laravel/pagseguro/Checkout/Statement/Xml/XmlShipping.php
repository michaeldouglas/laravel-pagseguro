<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

use laravel\pagseguro\Address\AddressInterface;
use laravel\pagseguro\Shipping\ShippingInterface;
use laravel\pagseguro\Complements\Filter\MoneyFilter;

/**
 * Checkout Statement Xml Shipping
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class XmlShipping implements XmlPartInterface
{
    /**
     * @var ShippingInterface
     */
    protected $shipping;

    /**
     * Constructor
     * @param ShippingInterface $shipping
     */
    public function __construct(ShippingInterface $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return string
     */
    public function getXmlString()
    {
        return
            '<shipping>' .
            $this->getTypeXmlString() .
            $this->getCostXmlString() .
            $this->getAddressXmlString($this->shipping->getAddress()) .
            '</shipping>';
    }

    /**
     * @return string XML
     */
    private function getTypeXmlString()
    {
        $str = '<type>%s</type>';
        return sprintf($str, $this->shipping->getType());
    }

    /**
     * @return string XML
     */
    private function getCostXmlString()
    {
        $cost = $this->shipping->getCost();
        $moneyFilter = new MoneyFilter();
        if (!$cost) {
            return null;
        }
        $str = '<cost>%s</cost>';
        return sprintf($str, $moneyFilter->filter($cost));
    }

    /**
     * @param AddressInterface $address
     * @return string XML
     */
    private function getAddressXmlString(AddressInterface $address)
    {
        $str = <<<XML
        <address>
            <street>%s</street>
            <number>%s</number>
            <complement>%s</complement>
            <district>%s</district>
            <postalCode>%s</postalCode>
            <city>%s</city>
            <state>%s</state>
            <country>%s</country>
        </address>
XML;
        return sprintf(
            $str,
            $address->getStreet(),
            $address->getNumber(),
            $address->getComplement(),
            $address->getDistrict(),
            $address->getPostalCode(),
            $address->getCity(),
            $address->getState(),
            $address->getCountry()
        );
    }
}
