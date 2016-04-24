<?php

namespace laravel\pagseguro\Session;

/**
 * Session Interface
 *
 * @category   Session
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Eduardo Alves <eduardoalves.info@gmail.com>
 *
 * @copyright  Laravel\PagSeguro
 */

interface SessionInterface
{

    /**
     * Get Session
     * @return string
     */
    public function getSession();
}