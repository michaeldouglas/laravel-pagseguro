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
 * @author     Eduardo Alves <eduardoalves.info@gmail.com>
 * @since      2016-04-21
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
        'installment' => 'Required',
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
