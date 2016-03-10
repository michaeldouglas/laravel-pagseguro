<?php

namespace laravel\pagseguro\Checkout\Metadata\Travel;

use laravel\pagseguro\Checkout\Metadata\HasMetadataInterface;
use laravel\pagseguro\Checkout\Metadata\Item;
use laravel\pagseguro\Checkout\Metadata\ItemGroup;
use laravel\pagseguro\Checkout\Metadata\MetadataCollection;

/**
 * Travel Metadata Exporter
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
     * @var TravelInterface
     */
    protected $exportable;

    /**
     * MetadataExport constructor.
     * @param TravelInterface $exportable
     */
    public function __construct(TravelInterface $exportable)
    {
        $this->exportable = $exportable;
    }

    /**
     * @return MetadataCollection
     */
    public function getMetadata()
    {
        $metadataCollection = new MetadataCollection([]);
        $this->appendDestination($metadataCollection);
        $this->appendOrigin($metadataCollection);
        $this->appendPassengers($metadataCollection);
        if (!$metadataCollection->count()) {
            return null;
        }
        return $metadataCollection;
    }

    /**
     * Append Place
     * @param MetadataCollection $metadataCollection
     * @param Place $place
     * @param string $airportKey
     * @param string $cityKey
     */
    private function appendPlace(
        MetadataCollection $metadataCollection,
        Place $place,
        $airportKey,
        $cityKey
    ) {
        $airport = $place->getAirportCode();
        $city = $place->getCity();
        if ($airport) {
            $item = new Item($airportKey, $airport);
            $metadataCollection->append($item);
        }
        if ($city) {
            $item = new Item($cityKey, $city);
            $metadataCollection->append($item);
        }
    }

    /**
     * @param MetadataCollection $metadataCollection
     * @return void
     */
    private function appendDestination(MetadataCollection $metadataCollection)
    {
        $place = $this->exportable->getDestination();
        if ($place) {
            $this->appendPlace(
                $metadataCollection,
                $place,
                Item::KEY_DESTINATION_AIRPORT_CODE,
                Item::KEY_DESTINATION_CITY
            );
        }
    }

    /**
     * @param MetadataCollection $metadataCollection
     * @return void
     */
    private function appendOrigin(MetadataCollection $metadataCollection)
    {
        $place = $this->exportable->getOrigin();
        if ($place) {
            $this->appendPlace(
                $metadataCollection,
                $place,
                Item::KEY_ORIGIN_AIRPORT_CODE,
                Item::KEY_ORIGIN_CITY
            );
        }
    }

    /**
     * @param MetadataCollection $metadataCollection
     * @return void
     */
    private function appendPassengers(MetadataCollection $metadataCollection)
    {
        $passengers = $this->exportable->getPassengers();
        if ($passengers && $passengers->count()) {
            foreach ($passengers as $passenger) {
                $this->appendPassenger($metadataCollection, $passenger);
            }
        }
    }

    /**
     * @param MetadataCollection $metadataCollection
     * @param Passenger $passenger
     * @return void
     */
    private function appendPassenger(
        MetadataCollection $metadataCollection,
        Passenger $passenger
    ) {
        $name = $passenger->getName();
        $cpf = $passenger->getCpf();
        $passport = $passenger->getPassport();
        $passCollection = new MetadataCollection();
        if ($name) {
            $item = new Item(Item::KEY_PASSENGER_NAME, $name);
            $passCollection->append($item);
        }
        if ($cpf) {
            $item = new Item(Item::KEY_PASSENGER_CPF, $cpf->getNumber());
            $passCollection->append($item);
        }
        if ($passport) {
            $item = new Item(Item::KEY_PASSENGER_PASSPORT, $passport->getNumber());
            $passCollection->append($item);
        }
        if ($passCollection->count()) {
            $metadataCollection->append(new ItemGroup(null, $passCollection));
        }
    }
}
