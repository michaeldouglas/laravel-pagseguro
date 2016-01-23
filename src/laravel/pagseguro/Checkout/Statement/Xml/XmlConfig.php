<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

use laravel\pagseguro\Checkout\CheckoutInterface;

/**
 * Checkout Statement Xml Config
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class XmlConfig implements XmlPartInterface
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
     * @return string
     */
    public function getXmlString()
    {
        return
            $this->getExtraAmountXmlString() .
            $this->getRedirectURLXmlString() .
            $this->getNotificationURLXmlString() .
            $this->getMaxUsesXmlString() .
            $this->getMaxAgeXmlString();
    }

    /**
     * @param string $key
     * @param string $value
     * @return null|string
     */
    private function optionalValue($key, $value)
    {
        if (is_null($value)) {
            return null;
        }
        $str = '<%1$s>%2$s</%1$s>';
        return sprintf($str, $key, $value);
    }

    /**
     * @return string XML
     */
    private function getExtraAmountXmlString()
    {
        $value = $this->checkout->getExtraAmount();
        return $this->optionalValue('extraAmount', $value);
    }

    /**
     * @return string XML
     */
    private function getRedirectURLXmlString()
    {
        $value = $this->checkout->getRedirectURL();
        return $this->optionalValue('redirectURL', $value);
    }

    /**
     * @return string XML
     */
    private function getNotificationURLXmlString()
    {
        $value = $this->checkout->getNotificationURL();
        return $this->optionalValue('notificationURL', $value);
    }

    /**
     * @return string XML
     */
    private function getMaxUsesXmlString()
    {
        $value = $this->checkout->getMaxUses();
        return $this->optionalValue('maxUses', $value);
    }

    /**
     * @return string XML
     */
    private function getMaxAgeXmlString()
    {
        $value = $this->checkout->getMaxAge();
        return $this->optionalValue('maxAge', $value);
    }
}
