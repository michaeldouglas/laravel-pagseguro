<?php

namespace laravel\pagseguro\Item;

use laravel\pagseguro\Helper\Helper;

/**
 * Classe responsável pela criação do objeto de item
 *
 * @category   Item
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 30/12/2014
 *
 * @copyright  Laravel\PagSeguro
 */
class Item
{

    /**
     * Item Unique Identifier (ID)
     * @var integer|string
     */
    private $id;
    
    /**
     * Item Description (Descrição)
     * @var string
     */
    private $description;
    
    /**
     * Item Quantity (Quantidade)
     * @var int
     */
    private $quantity;
    
    /**
     * Item price (Preço unitário)
     * @var float
     */
    private $amount;
    
    /**
     * Item Weight (Peso)
     * @var float
     */
    private $weight;
    
    /**
     * Item Shipping Cost (Valor de Trasporte / Frete)
     * @var float
     */
    private $shippingCost;

    /**
     * Irá verificar o array de item e setar as propriedades do item
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return void
     */
    public function __construct($item = null)
    {
        if (!is_null($item) && is_array($item)) {
            switch ($item) {
                case isset($item['id']):
                    $this->id = Helper::setVerifyKeyItem($item, 'id');
                case isset($item['description']):
                    $this->description = Helper::setVerifyKeyItem($item, 'description');

                case isset($item['quantity']):
                    $this->quantity = Helper::setVerifyKeyItem($item, 'quantity');

                case isset($item['amount']):
                    $this->amount = Helper::setVerifyKeyItem($item, 'amount');

                case isset($item['weight']):
                    $this->weight = Helper::setVerifyKeyItem($item, 'weight');

                case isset($item['shippingCost']):
                    $this->shippingCost = Helper::setVerifyKeyItem($item, 'shippingCost');
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
