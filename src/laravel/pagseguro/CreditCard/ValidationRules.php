<?php

namespace laravel\pagseguro\CreditCard;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   CreditCard
 * @package    Laravel\PagSeguro\CreditCard
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
class ValidationRules implements ValidationRulesInterface
{

    /**
     * @var array
     */
    protected $rules = [
        'token' => 'Required',
        'name' => 'Required|min:2|max:50',
        'documents' => 'Required',
        'phone' => 'Required',
        'birthDate' => 'Date',
        'billingAddress' => 'Required'
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
