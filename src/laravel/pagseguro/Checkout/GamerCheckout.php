<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Checkout\Metadata\Gamer\GameInfo;
use laravel\pagseguro\Checkout\Metadata\Gamer\Exporter;
use laravel\pagseguro\Checkout\Metadata\MetadataCollection;

/**
 * Gamer Checkout Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class GamerCheckout extends SimpleCheckout
{

    /**
     * @var GameInfo
     */
    protected $gameInfo;

    /**
     * @return GameInfo
     */
    public function getGameInfo()
    {
        return $this->gameInfo;
    }

    /**
     * @param GameInfo $gameInfo
     */
    public function setGameInfo(GameInfo $gameInfo)
    {
        $this->gameInfo = $gameInfo;
    }

    /**
     * @return MetadataCollection
     */
    public function getMetadata()
    {
        $gameInfo = $this->getGameInfo();
        if (!is_null($gameInfo)) {
            $exporter = new Exporter($gameInfo);
            $this->metadata = $exporter->getMetadata();
        }
        return parent::getMetadata();
    }
}
