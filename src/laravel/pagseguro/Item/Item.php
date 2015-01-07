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
                    $this->id = Helper::getValueOrDefault($item, 'id');
                case isset($item['description']):
                    $this->description = Helper::getValueOrDefault($item, 'description');

                case isset($item['quantity']):
                    $this->quantity = Helper::getValueOrDefault($item, 'quantity');

                case isset($item['amount']):
                    $this->amount = Helper::getValueOrDefault($item, 'amount');

                case isset($item['weight']):
                    $this->weight = Helper::getValueOrDefault($item, 'weight');

                case isset($item['shippingCost']):
                    $this->shippingCost = Helper::getValueOrDefault($item, 'shippingCost');
                    break;
                
                default:
                    throw new Exception('Nenhum parametro encontrado!');
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }
    
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function getWeight()
    {
        return $this->weight;
    }
    
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

}
