<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

use laravel\pagseguro\Complements\Filter\MoneyFilter;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Item\ItemInterface;

/**
 * Checkout Statement Xml Items
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class XmlItems implements XmlPartInterface
{
    /**
     * @var ItemCollection
     */
    protected $items;

    /**
     * Constructor
     * @param ItemCollection $items
     */
    public function __construct(ItemCollection $items)
    {
        $this->items = $items;
    }

    /**
     * @return string
     */
    public function getXmlString()
    {
        $str = '<items>%s</items>';
        $itemsStr = [];
        $iterator = $this->items->getIterator();
        while ($iterator->valid()) {
            $item = $iterator->current();
            $itemsStr[] = $this->getItemXmlString($item);
            $iterator->next();
        }
        return sprintf($str, implode('', $itemsStr));
    }

    /**
     * @param ItemInterface $item
     * @return string XML
     */
    private function getItemXmlString(ItemInterface $item)
    {
        $moneyFilter = new MoneyFilter();
        $str = <<<XML
        <item>
            <id>%s</id>
            <description>%s</description>
            <amount>%s</amount>
            <quantity>%s</quantity>
            %s
            %s
        </item>
XML;
        return sprintf(
            $str,
            $item->getId(),
            $item->getDescription(),
            $moneyFilter->filter($item->getAmount()),
            $item->getQuantity(),
            $this->getItemShippingCostXmlString($item),
            $this->getItemWeightXmlString($item)
        );
    }

    /**
     * @param ItemInterface $item
     * @return string XML
     */
    private function getItemShippingCostXmlString(ItemInterface $item)
    {
        $moneyFilter = new MoneyFilter();
        $str = '<shippingCost>%s</shippingCost>';
        $value = $item->getShippingCost();
        return !empty($value) ? sprintf($str, $moneyFilter->filter($value)) : null;
    }

    /**
     * @param ItemInterface $item
     * @return string XML
     */
    private function getItemWeightXmlString(ItemInterface $item)
    {
        $str = '<weight>%s</weight>';
        $value = $item->getWeight();
        return !empty($value) ? sprintf($str, $value) : null;
    }
}
