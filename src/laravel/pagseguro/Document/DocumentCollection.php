<?php

namespace laravel\pagseguro\Document;

use laravel\pagseguro\Document\CPF\CPF;

/**
 * Document Collection Object
 *
 * @category   Document
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
class DocumentCollection extends \ArrayObject
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
        $it = new \ArrayIterator($data);
        while($it->valid()) {
            $item = $it->current();
            if($item instanceof DocumentInterface) {
                $collectionItems[] = $item;
            } elseif (is_array($item)) {
                $collectionItems[] = self::DocumentFactory($item);
            } else {
                $exptMsg = sprintf('Invalid document on key: %s', $it->key());
                throw new \InvalidArgumentException ($exptMsg);
            }
            $it->next();
        }
        return new self($collectionItems);
    }

    /**
     * Factory Document
     * CPF is a unique suported document
     * @param array $data
     * @return DocumentInterface
     * @throws \InvalidArgumentException
     */
    public static function DocumentFactory(array $data)
    {
        if(
            !array_key_exists('type', $data)
            || !array_key_exists('number', $data)
            || empty($data['type'])
            || empty($data['number'])
        ) {
            throw new \InvalidArgumentException ('Invalid document data');
        }
        unset($data['type']);
        return new CPF($data);
    }

}
