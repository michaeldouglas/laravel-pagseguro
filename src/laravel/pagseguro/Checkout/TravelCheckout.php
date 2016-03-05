<?php

namespace laravel\pagseguro\Checkout;


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
     * @var Metadata\Travel\TravelInfo
     */
    protected $travelInfo;

    /**
     * @return Metadata\Travel\TravelInfo
     */
    public function getTravelInfo()
    {
        return $this->travelInfo;
    }

    /**
     * @param Metadata\Travel\TravelInfo $travelInfo
     */
    public function setTravelInfo(Metadata\Travel\TravelInfo $travelInfo)
    {
        $this->travelInfo = $travelInfo;
    }

    /**
     * @return Metadata\MetadataCollection
     */
    public function getMetadata()
    {
        $travelInfo = $this->getTravelInfo();
        if (!is_null($travelInfo)) {
            $exporter = new Metadata\Travel\Exporter($travelInfo);
            $this->metadata = $exporter->getMetadata();
        }
        return parent::getMetadata();
    }
}
