<?php

namespace laravel\pagseguro\Complements\Filter;

/**
 * Money Filter
 *
 * @category   Components
 * @package    Laravel\PagSeguro\Complements
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-10
 *
 * @copyright  Laravel\PagSeguro
 */
class MoneyFilter
{

    /**
     * @param float $value
     * @return string|float
     */
    public function filter($value)
    {
        if (empty($value)) {
            return null;
        }
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Invalid numeric type');
        }
        return number_format($value, 2, '.', '');
    }
}
