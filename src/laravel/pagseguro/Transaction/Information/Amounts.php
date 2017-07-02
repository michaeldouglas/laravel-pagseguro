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
    protected $grossAmount;

    /**
     * Discount Amount
     * @var float
     */
    protected $discountAmount;

    /**
     * Free Amount
     * @var float
     */
    protected $feeAmount;

    /**
     * Net Amount
     * @var float
     */
    protected $netAmount;

    /**
     * Extra Amount
     * @var float
     */
    protected $extraAmount;

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
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * Get Discount Amount
     * @return float
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * Get Free Amount
     * @return float
     */
    public function getFeeAmount()
    {
        return $this->feeAmount;
    }

    /**
     * Get Net Amount
     * @return float
     */
    public function getNetAmount()
    {
        return $this->netAmount;
    }

    /**
     * Get Extra Amount
     * @return float
     */
    public function getExtraAmount()
    {
        return $this->extraAmount;
    }

    /**
     * Set Gross Amout
     * @param float $grossAmount
     * @return Amounts
     */
    protected function setGrossAmount($grossAmount)
    {
        $this->grossAmount = $grossAmount;
        return $this;
    }

    /**
     * Set Discount Amount
     * @param float $discountAmount
     * @return Amounts
     */
    protected function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    /**
     * Set Free Amount
     * @param float $feeAmount
     * @return Amounts
     */
    protected function setFeeAmount($feeAmount)
    {
        $this->feeAmount = $feeAmount;
        return $this;
    }

    /**
     * Set Net Amount
     * @param float $netAmount
     * @return Amounts
     */
    protected function setNetAmount($netAmount)
    {
        $this->netAmount = $netAmount;
        return $this;
    }

    /**
     * Set Extra Amount
     * @param float $extraAmount
     * @return Amounts
     */
    protected function setExtraAmount($extraAmount)
    {
        $this->extraAmount = $extraAmount;
        return $this;
    }
}
