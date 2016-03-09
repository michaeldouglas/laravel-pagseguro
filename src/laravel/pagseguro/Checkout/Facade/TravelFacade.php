<?php

namespace laravel\pagseguro\Checkout\Facade;

use laravel\pagseguro\Checkout\Metadata\Travel\Passenger;
use laravel\pagseguro\Checkout\Metadata\Travel\PassengerCollection;
use laravel\pagseguro\Checkout\Metadata\Travel\Place;
use laravel\pagseguro\Checkout\Metadata\Travel\TravelInfo;
use laravel\pagseguro\Checkout\TravelCheckout;
use laravel\pagseguro\Document\CPF\CPF;
use laravel\pagseguro\Document\Passport\Passport;

/**
 * Travel Checkout Facade Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class TravelFacade
{
    /**
     * @param array $data
     * @param array|TravelInfo $travelInfo Keys:passengers|origin|destination
     * @return TravelCheckout
     */
    public function createCheckout(array $data, $travelInfo)
    {
        if (!($travelInfo instanceof TravelInfo)) {
            if (!is_array($travelInfo)) {
                throw new \InvalidArgumentException('Travel info not is array type');
            }
            $travelInfo = $this->createInfoFromArray($travelInfo);
        }
        $dataFacade = new DataFacade();
        $checkoutData = $dataFacade->ensureInstances($data);
        $checkout = new TravelCheckout($checkoutData);
        $checkout->setInfo($travelInfo);
        return $checkout;
    }

    /**
     * @param array $data
     * @return TravelInfo
     */
    public function createInfoFromArray(array $data)
    {
        $info = [];
        if (array_key_exists('passengers', $data)) {
            $info['passengers'] = $this->createPassengerCollectionFromArray($data['passengers']);
        }
        if (array_key_exists('origin', $data)) {
            $info['origin'] = $this->createPlaceFromArray($data['origin']);
        }
        if (array_key_exists('destination', $data)) {
            $info['destination'] = $this->createPlaceFromArray($data['destination']);
        }
        if (!count($info)) {
            throw new \InvalidArgumentException('Empty info data');
        }
        return new TravelInfo($info);
    }

    /**
     * @param array $data [name|cpf|passport]
     * @return Passenger
     */
    public function createPassengerFromArray(array $data)
    {
        $passengerData = [];
        if (array_key_exists('name', $data)) {
            $passengerData['name'] = $data['name'];
        }
        if (array_key_exists('cpf', $data)) {
            $passengerData['cpf'] = new CPF(['number' => $data['cpf']]);
        }
        if (array_key_exists('passport', $data)) {
            $passengerData['passport'] = new Passport(['number' => $data['passport']]);
        }
        if (!count($passengerData)) {
            throw new \InvalidArgumentException('Empty passenger data');
        }
        return new Passenger($passengerData);
    }

    /**
     * @param array $data [name|cpf|passport][]
     * @return PassengerCollection
     */
    public function createPassengerCollectionFromArray(array $data)
    {
        if (!count($data)) {
            throw new \InvalidArgumentException('Empty passengers data');
        }
        $collection = new PassengerCollection([]);
        foreach ($data as $passengerInfo) {
            $collection[] = $this->createPassengerFromArray($passengerInfo);
        }
        return $collection;
    }

    /**
     * @param array $data [city|airportCode][]
     * @return Place
     */
    public function createPlaceFromArray(array $data)
    {
        $placeData = [];
        if (array_key_exists('city', $data)) {
            $placeData['city'] = $data['city'];
        }
        if (array_key_exists('airportCode', $data)) {
            $placeData['airportCode'] = $data['airportCode'];
        }
        if (!count($placeData)) {
            throw new \InvalidArgumentException('Empty place data');
        }
        return new Place($placeData);
    }
}
