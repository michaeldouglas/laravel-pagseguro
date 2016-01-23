<?php

namespace laravel\pagseguro\Checkout\Metadata\Gamer;

use laravel\pagseguro\Checkout\Metadata\HasMetadataInterface;
use laravel\pagseguro\Checkout\Metadata\Item;
use laravel\pagseguro\Checkout\Metadata\MetadataCollection;

/**
 * Gamer Metadata Exporter
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class Exporter implements HasMetadataInterface
{

    /**
     * @var GamerInterface
     */
    protected $exportable;

    /**
     * MetadataExport constructor.
     * @param GamerInterface $exportable
     */
    public function __construct(GamerInterface $exportable)
    {
        $this->exportable = $exportable;
    }

    /**
     * @return MetadataCollection
     */
    public function getMetadata()
    {
        $metadataCollection = new MetadataCollection([]);
        $this->appendGameName($metadataCollection)
            ->appendPlayerId($metadataCollection)
            ->appendTimeInGame($metadataCollection);
        if (!$metadataCollection->count()) {
            return null;
        }
        return $metadataCollection;
    }

    /**
     * @param MetadataCollection $metadataCollection
     * @return Exporter
     */
    private function appendGameName(MetadataCollection $metadataCollection)
    {
        $gameName = $this->exportable->getGameName();
        if ($gameName) {
            $item = new Item(Item::KEY_GAME_NAME, $gameName);
            $metadataCollection->append($item);
        }
        return $this;
    }

    /**
     * @param MetadataCollection $metadataCollection
     * @return Exporter
     */
    private function appendPlayerId(MetadataCollection $metadataCollection)
    {
        $playerId = $this->exportable->getPlayerId();
        if ($playerId) {
            $item = new Item(Item::KEY_PLAYER_ID, $playerId);
            $metadataCollection->append($item);
        }
        return $this;
    }

    /**
     * @param MetadataCollection $metadataCollection
     * @return Exporter
     */
    private function appendTimeInGame(MetadataCollection $metadataCollection)
    {
        $timeInGameDays = $this->exportable->getTimeInGameDays();
        if ($timeInGameDays) {
            $item = new Item(Item::KEY_TIME_IN_GAME_DAYS, $timeInGameDays);
            $metadataCollection->append($item);
        }
        return $this;
    }
}
