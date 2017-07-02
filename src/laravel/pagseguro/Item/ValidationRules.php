<?php

namespace laravel\pagseguro\Item;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Item
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-10
 *
 * @copyright  Laravel\PagSeguro
 */
class ValidationRules implements ValidationRulesInterface
{

    /**
     * @var array
     */
    protected $rules = [
        'id' => 'Required|max:100',
        'description' => 'Required|max:100',
        'quantity' => 'Required|integer|between:1,999',
        'amount' => 'Required|numeric|between:0,9999999',
        'weight' => 'Integer|max:30000',
        'shippingCost' => 'Numeric|between:0,9999999',
        'width' => 'Numeric',
        'height' => 'Numeric',
        'length' => 'Numeric',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
