<?php

namespace laravel\pagseguro\CreditCard\Installment;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Installment
 * @package    Laravel\PagSeguro\CreditCard\Installment
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
        'quantity' => 'Required',
        'value' => 'Required'
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
