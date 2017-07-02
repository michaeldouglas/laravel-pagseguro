<?php

namespace laravel\pagseguro\Item;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Item Object
 *
 * @category   Item
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>, Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2014-12-30
 *
 * @copyright  Laravel\PagSeguro
 */
class Item implements ItemInterface
{

    /**
     * Item Unique Identifier (ID)
     * @var integer|string
     */
    protected $id;

    /**
     * Item Description (Descrição)
     * @var string
     */
    protected $description;

    /**
     * Item Quantity (Quantidade)
     * @var int
     */
    protected $quantity;

    /**
     * Item amount (Preço unitário)
     * @var float
     */
    protected $amount;

    /**
     * Item Weight (Peso)
     * @var float
     */
    protected $weight;

    /**
     * Item Shipping Cost (Valor de Trasporte / Frete)
     * @var float
     */
    protected $shippingCost;

    /**
     * Item Width (Largura)
     * @var float
     */
    protected $width;

    /**
     * Item Height (Altura)
     * @var float
     */
    protected $height;

    /**
     * Item Lenght (Comprimento)
     * @var float
     */
    protected $length;

    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Get Unique Identifier (ID)
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Description (Descrição)
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get Quantity (Quantidade)
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get Amount (Preço unitário)
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get Weight (Peso)
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get Shipping Cost (Frete)
     * @return float
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * Get Width (Largura)
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get Height (Altura)
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get Length (Comprimento)
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set Unique Identifier (ID)
     * @param int $id
     * @return Item
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set Description (Descrição)
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set Quantity (Quantidade)
     * @param int $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Set Amount (Preço)
     * @param float $amount
     * @return Item
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Set Weight (Peso)
     * @param float $weight
     * @return Item
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Set Shipping Cost (Frete)
     * @param float $shippingCost
     * @return Item
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    /**
     * Set Width (Largura)
     * @param float $width
     * @return Item
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Set Height (Altura)
     * @param float $height
     * @return Item
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Set Length (Comprimento)
     * @param float $length
     * @return Item
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}
