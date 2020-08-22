<?php

namespace laravel\pagseguro\Plans\PreApproval;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Sender Object
 *
 * @category   Sender
 * @package   laravel\pagseguro\Plans\Sender
 *
 * @author     Michael Araujo <michaeldouglas010790@gmail.com>
 * @since      2019-08-28
 *
 * @copyright  Laravel\PagSeguro
 */
class PreApproval implements PreApprovalInterface
{
    /**
     * Name (Nome)
     * @var string
     */
    protected $name;

    protected $charge;

    protected $period;

    protected $amountPerPayment;

    protected $trialPeriodDuration;

    protected $membershipFee;

    protected $details;

    protected $expiration;

    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
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
     * Get Name (Nome)
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this|PreApprovalInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getCharge()
    {
        return  $this->charge;
    }

    public function setCharge($charge)
    {
        $this->charge = $charge;

        return $this;
    }

    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    public function getPeriod()
    {
        return  $this->period;
    }

    public function setAmountPerPayment($amountPerPayment)
    {
        $this->amountPerPayment = $amountPerPayment;

        return $this;
    }

    public function getAmountPerPayment()
    {
        return  $this->amountPerPayment;
    }

    public function setTrialPeriodDuration($trialPeriodDuration)
    {
        $this->trialPeriodDuration = $trialPeriodDuration;
        return $this;
    }

    public function getTrialPeriodDuration()
    {
        return $this->trialPeriodDuration;
    }

    public function setMembershipFee($membershipFee)
    {
        $this->membershipFee = $membershipFee;
        return $this;
    }

    public function getMembershipFee()
    {
        return $this->membershipFee;
    }

    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;
        return $this;
    }

    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}
