<?php

namespace laravel\pagseguro\Plans\PreApproval;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Sender
 * @package    laravel\pagseguro\Plans\Sender
 *
 * @author     Michael Araujo <michaeldouglas010790@gmail.com>
 * @since      2019-08-28
 *
 * @copyright  Laravel\PagSeguro
 */
class ValidationRules implements ValidationRulesInterface
{
    /**
     * @var array
     */
    protected $rules = [
        'name' => 'Required|min:2|max:50',
        'charge' => 'Required',
        'period' => 'Required',
        'amountPerPayment' => '',
        'membershipFee' => '',
        'trialPeriodDuration' => '',
        'details' => '',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
