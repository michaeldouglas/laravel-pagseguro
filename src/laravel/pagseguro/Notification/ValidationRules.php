<?php

namespace laravel\pagseguro\Notification;

use laravel\pagseguro\Complements\ValidationRulesInterface;
use laravel\pagseguro\Complements\ValidationRulesTrait;

/**
 * Validation Rules Object
 *
 * @category   Notification
 * @package    Laravel\PagSeguro\Notification
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-09-15
 *
 * @copyright  Laravel\PagSeguro
 */
class ValidationRules implements ValidationRulesInterface
{

    /**
     * @var array
     */
    protected $rules = [
        'notificationCode' => 'Required|size:39',
        'notificationType' => 'Required|in:transaction',
    ];

    /**
     * @var array
     */
    protected $messages;

    use ValidationRulesTrait;
}
