<?php

namespace laravel\pagseguro\Sender\Document\CPF;

use laravel\pagseguro\Complements\ValidationRulesInterface,
    laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   SenderDocument
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
        'number' => 'Required|numeric|digits:11',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}