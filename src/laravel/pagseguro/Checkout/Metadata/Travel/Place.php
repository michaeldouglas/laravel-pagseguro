<?php

namespace laravel\pagseguro\Checkout\Metadata\Travel;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;

/**
 * Passenger Collection
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class Place
{

    /**
     * @var string
     */
    protected $airportCode;

    /**
     * @var string
     */
    protected $city;

    use DataHydratorTrait, DataHydratorProtectedTrait, DataHydratorConstructorTrait {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array|string $data Place data
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        $data = null;
        $this->hydrateMagic(
            ['city', 'airportCode'],
            $args
        );
    }

    /**
     * @return string
     */
    public function getAirportCode()
    {
        return $this->airportCode;
    }

    /**
     * @param string $airportCode
     * @return Place
     */
    protected function setAirportCode($airportCode)
    {
        $this->airportCode = $airportCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Place
     */
    protected function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
}
