<?php

namespace laravel\pagseguro\Address;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Address
 * @package    Laravel\PagSeguro\Address
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
        'postalCode' => 'Required|numeric|digits:8',
        'street' => 'Required|max:80',
        'number' => 'Required|max:20',
        'complement' => 'max:40',
        'district' => 'Required|max:60',
        'city' => 'Required|min:2|max:60',
        'state' => 'Required|max:2',
        'country' => 'Required|Max:3|in:BRA',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
