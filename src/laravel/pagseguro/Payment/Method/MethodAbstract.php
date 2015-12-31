<?php

namespace laravel\pagseguro\Payment\Method;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;

/**
 * Payment Method Interface
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
abstract class MethodAbstract implements MethodInterface
{

    protected $names = [];

    protected $type;

    protected $typeName;

    protected $code;

    use DataHydratorTrait,
        DataHydratorProtectedTrait,
        DataHydratorConstructorTrait
    {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct()
    {
        $this->hydrateMagic(['type', 'code', 'names'], func_get_args());
        if (!$this->type || !$this->code) {
            throw new \InvalidArgumentException('Type and Code are required');
        }
        $this->testCode();
    }

    /**
     * Test has code
     * @throws \InvalidArgumentException
     */
    protected function testCode()
    {
        if (!array_key_exists($this->code, $this->names)) {
            throw new \InvalidArgumentException('Unknow code: ' . $this->code);
        }
    }

    /**
     * Get Code
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get Name
     * @return string
     */
    public function getName()
    {
        return $this->names[$this->code];
    }

    /**
     * Get Type
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get Type Name
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Get Full Name
     * @return string
     */
    public function getFullName()
    {
        return $this->getTypeName() . ' ' . $this->getName();
    }
}
