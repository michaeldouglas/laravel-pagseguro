<?php

namespace laravel\pagseguro\Complements;

/**
 * Validation Rules Interface
 *
 * @category   Validation
 * @package    Laravel\PagSeguro\Complements
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-10
 *
 * @copyright  Laravel\PagSeguro
 */
interface ValidationRulesInterface
{

    /**
     * Get Rules Keys
     * @return array
     */
    public function getKeys();

    /**
     * Get Rules
     * @return array
     */
    public function getRules();

    /**
     * Get Messages
     * @return array
     */
    public function getMessages();

    /**
     * Set Messages
     * @param array $messages
     * @return array
     */
    public function setMessages(array $messages);
}
