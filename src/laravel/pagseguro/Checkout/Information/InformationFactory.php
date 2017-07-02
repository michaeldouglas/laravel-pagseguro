<?php

namespace laravel\pagseguro\Checkout\Information;

use laravel\pagseguro\Information\InformationAbstractFactory;

/**
 * Transaction Information Object Factory
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class InformationFactory extends InformationAbstractFactory
{

    /**
     * @return Information
     */
    public function getInformation()
    {
        $map = array_fill_keys([
            'code',
            'link',
        ], null);
        $data = array_intersect_key($this->data, $map);
        $data['date'] = $this->getDate();
        return new Information($data);
    }

    /**
     * Get Date
     * @return \DateTimeInterface
     */
    public function getDate()
    {
        return $this->getDateTimeObject($this->data['date']);
    }
}
