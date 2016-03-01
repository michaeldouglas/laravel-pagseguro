<?php

namespace laravel\pagseguro\Information;

/**
 * Information Object Factory
 *
 * @category   Information
 * @package    Laravel\PagSeguro\Information
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-10
 *
 * @copyright  Laravel\PagSeguro
 */
abstract class InformationAbstractFactory
{

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Information
     */
    abstract public function getInformation();

    /**
     * Get DateTimeObject
     * @param string $stringDate
     * @return \DateTimeInterface
     */
    protected function getDateTimeObject($stringDate)
    {
        $time = \str_replace('.000', '', $stringDate);
        return \DateTime::createFromFormat(\DateTime::W3C, $time);
    }
}
