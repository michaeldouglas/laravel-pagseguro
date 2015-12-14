<?php

namespace laravel\pagseguro\Proxy;

use laravel\pagseguro\Complements\ValidationRulesInterface,
    laravel\pagseguro\Complements\ValidationRulesTrait;

class ValidationRules implements ValidationRulesInterface {
    
    /**
     * @var array
     */
    protected $rules = [
        'user'     => 'Required',
        'password' => 'Required',
        'url'      => 'Required',
        'port'     => 'Required',
        'protocol' => 'Required'
    ];
    
    use ValidationRulesTrait;
}
