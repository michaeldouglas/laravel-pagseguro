<?php

namespace laravel\pagseguro\Checkout\Metadata\Travel;

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
class PassengerCollection extends \ArrayObject
{
    /**
     * Appends the value
     * @param TagableInterface $value <p>
     * The value being appended.
     * </p>
     * @return void
     */
    public function append($value)
    {
        if (!($value instanceof Passenger)) {
            throw new \InvalidArgumentException('Invalid passenger object');
        }
        parent::append($value);
    }

    /**
     * Sets the value at the specified index to newval
     * @param mixed $index <p>
     * The index being set.
     * </p>
     * @param TagableInterface $newval <p>
     * The new value for the <i>index</i>.
     * </p>
     * @return void
     */
    public function offsetSet($index, $newval)
    {
        if (!($newval instanceof Passenger)) {
            throw new \InvalidArgumentException('Invalid passenger object');
        }
        parent::offsetSet($index, $newval);
    }
}
