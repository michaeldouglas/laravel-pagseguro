<?php

namespace laravel\pagseguro\Checkout\Metadata\Gamer;

/**
 * Gamer Checkout Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface GamerInterface
{

    /**
     * @return string
     */
    public function getGameName();

    /**
     * @return string
     */
    public function getPlayerId();

    /**
     * @return int
     */
    public function getTimeInGameDays();
}
