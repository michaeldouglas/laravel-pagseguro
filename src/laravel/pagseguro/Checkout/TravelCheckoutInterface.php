<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Checkout\Travel\PassengerCollection;
use laravel\pagseguro\Checkout\Travel\Place;

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
interface TravelCheckoutInterface
{
    /**
     * @return Place
     */
    public function getDestination();

    /**
     * @param Place $place
     * @return CheckoutInterface
     */
    public function setDestination(Place $place);

    /**
     * @return Place
     */
    public function getOrigin();

    /**
     * @param Place $place
     * @return CheckoutInterface
     */
    public function setOrigin(Place $place);

    /**
     * @return PassengerCollection
     */
    public function getPassengers();

    /**
     * @param PassengerCollection $passengers
     * @return CheckoutInterface
     */
    public function setPassengers(PassengerCollection $passengers);
}
