<?php

namespace laravel\pagseguro\Checkout\Information;

use laravel\pagseguro\Information\InformationAbstract;

/**
 * Checkout Information Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Information extends InformationAbstract
{

    /**
     * Transaction Code
     * @var string
     */
    protected $code;

    /**
     * Date
     * @var \DateTime
     */
    protected $date;

    /**
     * Link
     * @var string
     */
    protected $link;

    /**
     * Transaction Code
     * @param string $code
     * @throws \InvalidArgumentException
     */
    protected function setCode($code)
    {
        if (!\is_string($code)) {
            throw new \InvalidArgumentException('Invalid transaction code');
        }
        $this->code = $code;
    }

    /**
     * Get Code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get Date
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Information
     */
    protected function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get Link
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
