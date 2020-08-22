<?php

namespace laravel\pagseguro\Plans\PreApproval\Expiration;

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
        'value' => 'required|int|min:1|max:1000000',
        'unit' => 'required|string',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
