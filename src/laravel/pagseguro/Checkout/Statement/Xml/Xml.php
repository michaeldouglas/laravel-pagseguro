<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

use laravel\pagseguro\Checkout\CheckoutInterface;
use laravel\pagseguro\Checkout\Statement\StatementInterface;
use laravel\pagseguro\Http\Request\RequestInterface;

/**
 * Checkout Statement Xml
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class Xml implements StatementInterface
{
    /**
     * @var CheckoutInterface
     */
    protected $checkout;

    /**
     * Constructor
     * @param CheckoutInterface $checkout
     */
    public function __construct(CheckoutInterface $checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * @param RequestInterface $request
     * @return void
     */
    public function prepare(RequestInterface $request)
    {
        $xml = $this->getCheckoutAsXml();
        $charset = $this->checkout->getCharset();
        $request->setData($xml)
            ->setCharset($charset)
            ->setHeaders([
                'Content-Type' => 'application/xml; charset=' . $charset
            ]);
    }

    /**
     * @return string XML
     */
    private function getCheckoutAsXml()
    {
        return
            $this->getTagXmlString() . '<checkout>' .
            $this->getReceiverXmlString() .
            $this->getCurrencyXmlString() .
            $this->getItemsXmlString() .
            $this->getReferenceXmlString() .
            $this->getSenderXmlString() .
            $this->getShippingXmlString() .
            $this->getConfigXmlString() .
            $this->getMetadataXmlString() .
            '</checkout>';
    }

    /**
     * @return string XML
     */
    private function getTagXmlString()
    {
        $str = '<?xml version="1.0" encoding="%s" standalone="yes"?>';
        return sprintf($str, $this->checkout->getCharset());
    }

    /**
     * @return string XML
     */
    private function getCurrencyXmlString()
    {
        $str = '<currency>%s</currency>';
        return sprintf($str, $this->checkout->getCurrency());
    }

    /**
     * @return string XML
     */
    private function getReceiverXmlString()
    {
        $str = '<receiver><email>%s</email></receiver>';
        $receiver = $this->checkout->getReceiver();
        $value = $receiver ? $receiver->getEmail() : null;
        return !empty($value) ? sprintf($str, $value) : null;
    }

    /**
     * @return string XML
     */
    private function getReferenceXmlString()
    {
        $str = '<reference>%s</reference>';
        $value = $this->checkout->getReference();
        return !empty($value) ? sprintf($str, $value) : null;
    }

    /**
     * @return string XML
     */
    private function getItemsXmlString()
    {
        $xmlItems = new XmlItems($this->checkout->getItems());
        return $xmlItems->getXmlString();
    }

    /**
     * @return string XML
     */
    private function getSenderXmlString()
    {
        $sender = $this->checkout->getSender();
        if (!$sender) {
            return null;
        }
        $xmlItems = new XmlSender($sender);
        return $xmlItems->getXmlString();
    }

    /**
     * @return string XML
     */
    private function getShippingXmlString()
    {
        $shipping = $this->checkout->getShipping();
        if (!$shipping) {
            return null;
        }
        $xmlItems = new XmlShipping($shipping);
        return $xmlItems->getXmlString();
    }

    /**
     * @return string XML
     */
    private function getConfigXmlString()
    {
        $xmlItems = new XmlConfig($this->checkout);
        return $xmlItems->getXmlString();
    }

    /**
     * @return string XML
     */
    private function getMetadataXmlString()
    {
        $xmlItems = new XmlMetadata($this->checkout->getMetadata());
        return $xmlItems->getXmlString();
    }
}
