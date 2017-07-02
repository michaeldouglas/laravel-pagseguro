<?php

namespace laravel\pagseguro\Item;

/**
 * Item Interface
 *
 * @category   Item
 * @package    Laravel\PagSeguro\Item
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-01-09
 *
 * @copyright  Laravel\PagSeguro
 */
interface ItemInterface
{

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = []);

    /**
     * Get Unique Identifier (ID)
     * @return int
     */
    public function getId();

    /**
     * Get Description (Descrição)
     * @return string
     */
    public function getDescription();

    /**
     * Get Quantity (Quantidade)
     * @return int
     */
    public function getQuantity();

    /**
     * Get Amount (Preço unitário)
     * @return float
     */
    public function getAmount();

    /**
     * Get Weight (Peso)
     * @return float
     */
    public function getWeight();

    /**
     * Get Shipping Cost (Frete)
     * @return float
     */
    public function getShippingCost();

    /**
     * Get Width (Largura)
     * @return float
     */
    public function getWidth();

    /**
     * Get Height (Altura)
     * @return float
     */
    public function getHeight();

    /**
     * Get Length (Comprimento)
     * @return float
     */
    public function getLength();

    /**
     * Set Unique Identifier (ID)
     * @param int $id
     * @return Item
     */
    public function setId($id);

    /**
     * Set Description (Descrição)
     * @param string $description
     * @return Item
     */
    public function setDescription($description);

    /**
     * Set Quantity (Quantidade)
     * @param int $quantity
     * @return Item
     */
    public function setQuantity($quantity);

    /**
     * Set Amount (Preço)
     * @param float $amount
     * @return Item
     */
    public function setAmount($amount);

    /**
     * Set Weight (Peso)
     * @param float $weight
     * @return Item
     */
    public function setWeight($weight);

    /**
     * Set Shipping Cost (Frete)
     * @param float $shippingCost
     * @return Item
     */
    public function setShippingCost($shippingCost);

    /**
     * Set Width (Largura)
     * @param float $width
     * @return Item
     */
    public function setWidth($width);

    /**
     * Set Height (Altura)
     * @param float $height
     * @return Item
     */
    public function setHeight($height);

    /**
     * Set Length (Comprimento)
     * @param float $length
     * @return Item
     */
    public function setLength($length);

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = []);

    /**
     * Test Valid Data
     * @return bool
     */
    public function isValid();

    /**
     * Get Validator
     * Return only after hydrate
     * @return null|\Illuminate\Validation\Validator
     */
    public function getValidator();

    /**
     * Cast Array
     * @return array
     */
    public function toArray();
}
