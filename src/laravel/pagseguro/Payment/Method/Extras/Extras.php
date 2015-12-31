<?php

namespace laravel\pagseguro\Payment\Method\Extras;

use laravel\pagseguro\Payment\Method\MethodAbstract;

/**
 * Payment Method Deposit Account Object
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Extras extends MethodAbstract implements ExtrasInterface
{

    /**
     * @var int
     */
    protected $type;

    /**
     * @var array
     */
    protected $typeNames = [
        self::TYPE_OI_PAGGO => 'Oi Paggo',
        self::TYPE_PS_CREDIT => 'Saldo PagSeguro'
    ];

    /**
     * Test has code
     * @throws \InvalidArgumentException
     */
    protected function testCode()
    {
        if (!array_key_exists($this->type, $this->typeNames)) {
            throw new \InvalidArgumentException('Unknow type: ' . $this->type);
        }
    }
    
    /**
     * Get Name
     * @return string
     */
    public function getName()
    {
        return null;
    }

    /**
     * Get Type Name
     * @return string
     */
    public function getTypeName()
    {
        return $this->type ? $this->typeNames[$this->type] : null;
    }

    /**
     * Get Full Name
     * @return string
     */
    public function getFullName()
    {
        return $this->getTypeName();
    }
}
