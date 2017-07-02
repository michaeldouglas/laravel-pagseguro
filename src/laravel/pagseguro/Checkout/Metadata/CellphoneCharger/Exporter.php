<?php

namespace laravel\pagseguro\Checkout\Metadata\CellphoneCharger;

use laravel\pagseguro\Checkout\Metadata\HasMetadataInterface;
use laravel\pagseguro\Checkout\Metadata\Item;
use laravel\pagseguro\Checkout\Metadata\MetadataCollection;

/**
 * Cellphone Charge Metadata Exporter
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class Exporter implements HasMetadataInterface
{

    /**
     * @var CellphoneChargerInterface
     */
    protected $exportable;

    /**
     * MetadataExport constructor.
     * @param CellphoneChargerInterface $exportable
     */
    public function __construct(CellphoneChargerInterface $exportable)
    {
        $this->exportable = $exportable;
    }

    /**
     * @return MetadataCollection
     */
    public function getMetadata()
    {
        $phone = $this->exportable->getPhone();
        if (!$phone) {
            return null;
        }
        $phoneNumber = implode('', [
            $phone->getCountryCode(),
            $phone->getAreaCode(),
            $phone->getNumber(),
        ]);
        $item = new Item(Item::KEY_MOBILE_NUMBER, $phoneNumber);
        return new MetadataCollection([$item]);
    }
}
