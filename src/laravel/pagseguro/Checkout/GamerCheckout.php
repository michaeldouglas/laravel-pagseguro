<?php

namespace laravel\pagseguro\Checkout;

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
     * @var Metadata\Gamer\GameInfo
     */
    protected $gameInfo;

    /**
     * @return Metadata\Gamer\GameInfo
     */
    public function getGameInfo()
    {
        return $this->gameInfo;
    }

    /**
     * @param Metadata\Gamer\GameInfo $gameInfo
     */
    public function setGameInfo(Metadata\Gamer\GameInfo $gameInfo)
    {
        $this->gameInfo = $gameInfo;
    }

    /**
     * @return Metadata\MetadataCollection
     */
    public function getMetadata()
    {
        $gameInfo = $this->getGameInfo();
        if (!is_null($gameInfo)) {
            $exporter = new Metadata\Gamer\Exporter($gameInfo);
            $this->metadata = $exporter->getMetadata();
        }
        return parent::getMetadata();
    }
}
