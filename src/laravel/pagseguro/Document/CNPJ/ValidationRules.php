<?php

namespace laravel\pagseguro\Document\CNPJ;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Document
 * @package    Laravel\PagSeguro\Document
 *
 * @author     José Tobias de Freitas Neto <jtfnetoo@gmail.com>
 * @since      2018-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class ValidationRules implements ValidationRulesInterface
{

    /**
     * @var array
     */
    protected $rules = [
        'number' => 'Required|numeric|digits:14',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
