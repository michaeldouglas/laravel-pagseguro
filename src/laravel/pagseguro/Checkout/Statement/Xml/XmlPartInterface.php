<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

/**
 * Checkout Statement Xml Part Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface XmlPartInterface
{
    /**
     * @return string
     */
    public function getXmlString();
}
