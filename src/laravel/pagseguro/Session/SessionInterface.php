<?php

namespace laravel\pagseguro\Session;

/**
 * Created by PhpStorm.
 * User: ealves
 * Date: 21/04/16
 * Time: 16:26
 */


interface SessionInterface
{

    /**
     * Get Session
     * @return string
     */
    public function getSession();
}