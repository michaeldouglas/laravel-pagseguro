<?php

namespace laravel\pagseguro\Checkout\Metadata\Gamer;

use laravel\pagseguro\Checkout\Metadata\InfoInterface;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;

/**
 * Gamer Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class GameInfo implements GamerInterface, InfoInterface
{

    /**
     * @var string
     */
    protected $gameName;

    /**
     * @var string
     */
    protected $playerId;

    /**
     * @var int
     */
    protected $timeInGameDays;

    use DataHydratorTrait, DataHydratorProtectedTrait, DataHydratorConstructorTrait {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array|string $data Game Info Data
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        $data = null;
        $this->hydrateMagic(
            ['gameName', 'playerId', 'timeInGameDays'],
            $args
        );
    }

    /**
     * @return int
     */
    public function getTimeInGameDays()
    {
        return $this->timeInGameDays;
    }

    /**
     * @param int $timeInGameDays
     * @return GameInfo
     */
    protected function setTimeInGameDays($timeInGameDays)
    {
        $this->timeInGameDays = $timeInGameDays;
        return $this;
    }

    /**
     * @return string
     */
    public function getGameName()
    {
        return $this->gameName;
    }

    /**
     * @param string $gameName
     * @return GameInfo
     */
    protected function setGameName($gameName)
    {
        $this->gameName = $gameName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @param string $playerId
     * @return GameInfo
     */
    protected function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
        return $this;
    }
}
