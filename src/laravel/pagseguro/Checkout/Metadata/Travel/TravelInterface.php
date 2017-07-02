<?php

namespace laravel\pagseguro\Checkout\Metadata\Travel;

/**
 * Travel Checkout Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface TravelInterface
{
    /**
     * @return Place
     */
    public function getDestination();

    /**
     * @param Place $place
     * @return TravelInterface
     */
    public function setDestination(Place $place);

    /**
     * @return Place
     */
    public function getOrigin();

    /**
     * @param Place $place
     * @return TravelInterface
     */
    public function setOrigin(Place $place);

    /**
     * @return PassengerCollection
     */
    public function getPassengers();

    /**
     * @param PassengerCollection $passengers
     * @return TravelInterface
     */
    public function setPassengers(PassengerCollection $passengers);
}
