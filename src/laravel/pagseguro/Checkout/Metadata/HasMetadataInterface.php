<?php

namespace laravel\pagseguro\Checkout\Metadata;

/**
 * Metadata Exists Interface
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
interface HasMetadataInterface
{
    /**
     * @return MetadataCollection
     */
    public function getMetadata();
}
