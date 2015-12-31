<?php

namespace laravel\pagseguro\Transaction\Information;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;

/**
 * Transaction Amounts Information Object
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Amounts
{

    /**
     * Gross Amount
     * @var float
     */
    protected $grossamount;

    /**
     * Discount Amount
     * @var float
     */
    protected $discountamount;

    /**
     * Free Amount
     * @var float
     */
    protected $feeamount;

    /**
     * Net Amount
     * @var float
     */
    protected $netamount;

    /**
     * Extra Amount
     * @var float
     */
    protected $extraamount;

    use DataHydratorTrait, DataHydratorProtectedTrait {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Get Gross Amount
     * @return float
     */
    public function getGrossamount()
    {
        return $this->grossamount;
    }

    /**
     * Get Discount Amount
     * @return float
     */
    public function getDiscountamount()
    {
        return $this->discountamount;
    }

    /**
     * Get Free Amount
     * @return float
     */
    public function getFeeamount()
    {
        return $this->feeamount;
    }

    /**
     * Get Net Amount
     * @return float
     */
    public function getNetamount()
    {
        return $this->netamount;
    }

    /**
     * Get Extra Amount
     * @return float
     */
    public function getExtraamount()
    {
        return $this->extraamount;
    }

    protected function setGrossamount($grossamount)
    {
        $this->grossamount = $grossamount;
        return $this;
    }

    protected function setDiscountamount($discountamount)
    {
        $this->discountamount = $discountamount;
        return $this;
    }

    protected function setFeeamount($feeamount)
    {
        $this->feeamount = $feeamount;
        return $this;
    }

    protected function setNetamount($netamount)
    {
        $this->netamount = $netamount;
        return $this;
    }

    protected function setExtraamount($extraamount)
    {
        $this->extraamount = $extraamount;
        return $this;
    }
}
