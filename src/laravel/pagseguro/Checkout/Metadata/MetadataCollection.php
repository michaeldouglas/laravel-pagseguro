<?php

namespace laravel\pagseguro\Checkout\Metadata;

/**
 * Metadata Collection
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class MetadataCollection extends \ArrayObject
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
        if (!($value instanceof TagableInterface)) {
            throw new \InvalidArgumentException('Invalid tagable object');
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
        if (!($newval instanceof TagableInterface)) {
            throw new \InvalidArgumentException('Invalid tagable object');
        }
        parent::offsetSet($index, $newval);
    }
}
