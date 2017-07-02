<?php

namespace laravel\pagseguro\Checkout\Metadata\Travel;

use laravel\pagseguro\Checkout\Metadata\InfoInterface;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;

/**
 * Travel Info Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class TravelInfo implements TravelInterface, InfoInterface
{

    /**
     * @var Place
     */
    protected $destination;

    /**
     * @var Place
     */
    protected $origin;

    /**
     * @var PassengerCollection
     */
    protected $passengers;

    use DataHydratorTrait, DataHydratorProtectedTrait, DataHydratorConstructorTrait {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array|string $data Travel Info Data
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        $data = null;
        $this->hydrateMagic(
            ['passengers', 'origin', 'destination'],
            $args
        );
    }

    /**
     * @return Place
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param Place $place
     * @return TravelInterface
     */
    public function setDestination(Place $place)
    {
        $this->destination = $place;
    }

    /**
     * @return Place
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param Place $place
     * @return TravelInterface
     */
    public function setOrigin(Place $place)
    {
        $this->origin = $place;
    }

    /**
     * @return PassengerCollection
     */
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     * @param PassengerCollection $passengers
     * @return TravelInterface
     */
    public function setPassengers(PassengerCollection $passengers)
    {
        $this->passengers = $passengers;
    }
}
