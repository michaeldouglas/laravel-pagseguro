<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Checkout\Metadata\Travel\TravelInfo;
use laravel\pagseguro\Checkout\Metadata\Travel\Exporter;
use laravel\pagseguro\Checkout\Metadata\MetadataCollection;

/**
 * Travel Checkout Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class TravelCheckout extends SimpleCheckout
{

    /**
     * @var TravelInfo
     */
    protected $travelInfo;

    /**
     * @return TravelInfo
     */
    public function getTravelInfo()
    {
        return $this->travelInfo;
    }

    /**
     * @param TravelInfo $travelInfo
     */
    public function setTravelInfo(TravelInfo $travelInfo)
    {
        $this->travelInfo = $travelInfo;
    }

    /**
     * @return MetadataCollection
     */
    public function getMetadata()
    {
        $travelInfo = $this->getTravelInfo();
        if (!is_null($travelInfo)) {
            $exporter = new Exporter($travelInfo);
            $this->metadata = $exporter->getMetadata();
        }
        return parent::getMetadata();
    }
}
