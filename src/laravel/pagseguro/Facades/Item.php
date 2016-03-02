<?php

namespace laravel\pagseguro\Facades;

use laravel\pagseguro\Item\Item as CartItem;
use laravel\pagseguro\Item\ItemCollection;

/**
 * Item Facade
 * @author  Isaque de Souza <isaquesb@gmail.com>
 */
class Item
{

    /**
     * Create Item Instance
     * @param array $data
     * @return Item
     */
    public function create(array $data = [])
    {
        return new CartItem($data);
    }

    /**
     * Create Item Collection Instance
     * @param array $data
     * @return ItemCollection
     */
    public function createCollection(array $data = [])
    {
        return ItemCollection::factory($data);
    }
}
