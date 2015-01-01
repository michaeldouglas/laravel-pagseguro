<?php

/**
 * Classe responsável pela criação do objeto de item
 *
 * @category   item
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 30/12/2014
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Item;

class Item
{

    private $id;
    private $description;
    private $quantity;
    private $amount;
    private $weight;
    private $shippingCost;

    /**
     * Irá verificar o array de item e setar as propriedades do item
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return void
     */
    public function __construct($item = null)
    {
        if (!is_null($item) && is_array($item)) {
            switch ($item) {
                case isset($item['id']):
                    $this->id = $this->setVerifyKeyItem($item, 'id');
                case isset($item['description']):
                    $this->description = $this->setVerifyKeyItem($item, 'description');

                case isset($item['quantity']):
                    $this->quantity = $this->setVerifyKeyItem($item, 'quantity');

                case isset($item['amount']):
                    $this->amount = $this->setVerifyKeyItem($item, 'amount');

                case isset($item['weight']):
                    $this->weight = $this->setVerifyKeyItem($item, 'weight');

                case isset($item['shippingCost']):
                    $this->shippingCost = $this->setVerifyKeyItem($item, 'shippingCost');
                    break;
                
                default:
                    throw new Exception('Nenhum parametro encontrado!');
            }
        }
    }
    
    private function setVerifyKeyItem($item, $key){
        return (array_key_exists($key, $item) ? $item[$key] : null);
    }

    public function getItemId()
    {
        return $this->id;
    }

    public function getItemDescription()
    {
        return $this->description;
    }
    
    public function getItemQuantity()
    {
        return $this->quantity;
    }
    
    public function getItemAmount()
    {
        return $this->amount;
    }
    
    public function getItemWeight()
    {
        return $this->weight;
    }
    
    public function getItemShippingCost()
    {
        return $this->shippingCost;
    }

}
