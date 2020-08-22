<?php

namespace laravel\pagseguro\Plans\PreApproval;

/**
 * Sender Interface
 *
 * @category   Sender
 * @package   laravel\pagseguro\Plans\Sender
 *
 * @author     Michael Araujo <michaeldouglas010790@gmail.com>
 * @since      2019-08-28
 *
 * @copyright  Laravel\PagSeguro
 */
interface PreApprovalInterface
{

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = []);

    /**
     * Get Name (Nome)
     * @return string
     */
    public function getName();

    /**
     * Set Name
     * @param string $name
     * @return PreApprovalInterface
     */
    public function setName($name);

    public function getCharge();

    public function setCharge($charge);

    public function setPeriod($period);

    public function getPeriod();

    public function setAmountPerPayment($amountPerPayment);

    public function getAmountPerPayment();

    public function setTrialPeriodDuration($trialPeriodDuration);

    public function getTrialPeriodDuration();

    public function setMembershipFee($membershipFee);

    public function getMembershipFee();

    public function setDetails($details);

    public function getDetails();

    public function setExpiration($expiration);

    public function getExpiration();

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = []);

    /**
     * Test Valid Data
     * @return bool
     */
    public function isValid();

    /**
     * Get Validator
     * Return only after hydrate
     * @return null|\Illuminate\Validation\Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
