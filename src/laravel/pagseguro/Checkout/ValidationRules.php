<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class ValidationRules implements ValidationRulesInterface
{

    /**
     * @var array
     */
    protected $rules = [
        'address' => 'Required',
        'currency' => 'Required|in:BRL',
        'items' => 'Required',
        'notificationURL' => 'Url',
        'redirectURL' => 'Url',
        'reference' => 'String',
        'maxAge' => 'Integer',
        'maxUses' => 'Integer',
        'metadata' => 'Array',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}