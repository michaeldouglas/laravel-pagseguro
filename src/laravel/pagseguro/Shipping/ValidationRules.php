<?php

namespace laravel\pagseguro\Shipping;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Shipping
 * @package    Laravel\PagSeguro\Shipping
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
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
        'cost' => 'Required|numeric|between:0,9999999',
        'type' => 'Required|integer|between:1,3',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
