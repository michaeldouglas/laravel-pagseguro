<?php

namespace laravel\pagseguro\Checkout\Metadata;

/**
 * Metadata Item Group
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class ItemGroup extends Item
{
    /**
     * @var array
     */
    protected $value = [];

    /**
     * @param string $key
     */
    protected function setKey($key)
    {
        if (null !== $key) {
            throw new \InvalidArgumentException('Group can\'t have key');
        }
    }

    /**
     * @param string $value
     */
    protected function setValue($value)
    {
        if (!($value instanceof MetadataCollection)) {
            throw new \InvalidArgumentException('Invalid metadata collection');
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toXmlTag()
    {
        $str = <<<XML
        <item>
            <key>%s</key>
            <value>%s</value>
        </item>
XML;
        $tag = <<<XML
        <group>
            %s
        </group>
XML;
        $groups = [];
        foreach ($this->getValue() as $item) {
            $groups[] = sprintf($str, $item->getKey(), $item->getValue());
        }
        return sprintf($tag, implode('', $groups));
    }
}
