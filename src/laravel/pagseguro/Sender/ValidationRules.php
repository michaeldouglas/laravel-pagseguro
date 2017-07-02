<?php

namespace laravel\pagseguro\Sender;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Sender
 * @package    Laravel\PagSeguro\Sender
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
        'email' => 'Required|Email',
        'name' => 'Required|min:2|max:50',
        'documents' => 'Required',
        'phone' => 'Required',
        'bornDate' => 'Date',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
