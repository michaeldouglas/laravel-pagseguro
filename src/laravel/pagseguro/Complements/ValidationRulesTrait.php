<?php

namespace laravel\pagseguro\Complements;

/**
 * Validation Rules Trait
 *
 * @category   Validation
 * @package    Laravel\PagSeguro\Complements
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-10
 *
 * @copyright  Laravel\PagSeguro
 */
trait ValidationRulesTrait
{

    /**
     * Get Rules Keys
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->rules);
    }

    /**
     * Get Rules
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Get Validate Messages
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set Validate Messages
     * @param array $messages
     * @return object
     */
    public function setMessages(array $messages)
    {
        $this->messages = $messages;
        return $this;
    }
}
