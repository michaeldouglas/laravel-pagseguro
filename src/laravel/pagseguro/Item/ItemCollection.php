<?php

namespace laravel\pagseguro\Item;

/**
 * Item Collection Object
 *
 * @category   Item
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-09
 *
 * @copyright  Laravel\PagSeguro
 */
class ItemCollection extends \ArrayObject
{

    /**
     * Factory ItemCollection (Cria coleção de itens)
     * @param array $data Items
     * @return ItemCollection
     * @throws \InvalidArgumentException
     */
    public static function factory(array $data = [])
    {
        $collectionItems = [];
        $itr = new \ArrayIterator($data);
        while ($itr->valid()) {
            $item = $itr->current();
            if ($item instanceof ItemInterface) {
                $collectionItems[] = $item;
            } elseif (is_array($item)) {
                $collectionItems[] = new Item($item);
            } else {
                $exptMsg = sprintf('Invalid item on key: %s', $itr->key());
                throw new \InvalidArgumentException($exptMsg);
            }
            $itr->next();
        }
        return new self($collectionItems);
    }
}
