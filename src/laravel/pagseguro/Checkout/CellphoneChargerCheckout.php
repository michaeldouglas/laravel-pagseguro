<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Checkout\Metadata\CellphoneCharger\CellphoneChargerInterface;
use laravel\pagseguro\Checkout\Metadata\CellphoneCharger\Exporter;
use laravel\pagseguro\Checkout\Metadata\MetadataCollection;
use laravel\pagseguro\Phone\PhoneInterface;

/**
 * Cellphone Charger Checkout Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class CellphoneChargerCheckout extends SimpleCheckout implements CellphoneChargerInterface
{

    /**
     * @var PhoneInterface
     */
    protected $phone;

    /**
     * @return PhoneInterface
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param PhoneInterface $phone
     * @return CellphoneChargerCheckout
     */
    public function setPhone(PhoneInterface $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return MetadataCollection
     */
    public function getMetadata()
    {
        $exporter = new Exporter($this);
        $this->metadata = $exporter->getMetadata();
        return parent::getMetadata();
    }
}
