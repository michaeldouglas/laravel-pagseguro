<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Checkout\Metadata\InfoInterface;

/**
 * HasInfo Trait
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-03-09
 *
 * @copyright  Laravel\PagSeguro
 */
trait HasInfoTrait
{

    /**
     * @var InfoInterface
     */
    protected $info;

    /**
     * @return InfoInterface
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param InfoInterface $info
     */
    public function setInfo(InfoInterface $info)
    {
        $this->info = $info;
    }

    /**
     * @return Metadata\MetadataCollection
     */
    public function getMetadata()
    {
        $info = $this->getInfo();
        if (!is_null($info)) {
            $exporterClass = preg_replace(
                '/(.*)\\\(.*)Checkout$/',
                '$1\Metadata\\\$2\Exporter',
                __CLASS__
            );
            $exporter = new $exporterClass($info);
            $this->metadata = $exporter->getMetadata();
        }
        return parent::getMetadata();
    }
}
