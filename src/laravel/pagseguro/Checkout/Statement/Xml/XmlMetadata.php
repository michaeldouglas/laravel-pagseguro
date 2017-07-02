<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

use laravel\pagseguro\Checkout\Metadata\MetadataCollection;

/**
 * Checkout Statement Xml Metadata
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class XmlMetadata implements XmlPartInterface
{
    /**
     * @var MetadataCollection
     */
    protected $metadata;

    /**
     * Constructor
     * @param MetadataCollection $metadata
     */
    public function __construct($metadata = null)
    {
        if (!empty($metadata)) {
            if (!($metadata instanceof MetadataCollection)) {
                throw new \InvalidArgumentException('Invalid metadata');
            }
            $this->metadata = $metadata;
        }
    }

    /**
     * @return string
     */
    public function getXmlString()
    {
        if (is_null($this->metadata)) {
            return null;
        }
        $strCollection = [];
        foreach ($this->metadata as $tagable) {
            $strCollection[] = $tagable->toXmlTag();
        }
        $str = <<<XML
        <metadata>
            %s
        </metadata>
XML;
        return sprintf($str, implode('', $strCollection));
    }
}
