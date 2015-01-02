<?php

/**
 * Classe responsável por prover uma solicitação de pagamento
 *
 * @category   Payment
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 30/12/2014
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro;

use laravel\pagseguro\Request\Request,
    laravel\pagseguro\Item\Item,
    laravel\pagseguro\Address\Address;

class Payment extends Request
{

    protected $dataItem;
    private   $reference = 'REF1';
    private   $currency = 'BRL';
    private   $shipping = NULL;
    private   $item = array();
    private   $items = array();
    private   $childrenItems = array();
    protected $address = array();

    /**
     * Irá verificar se os dados de item fornecidos estão válidos e também
     * se no item contém mais de uma requisição de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object|array
     */
    public function setAddItem(array $dataItem = null)
    {
        $this->setValidateItem($dataItem);
        $this->setVerifyItem();
    }

    /**
     * Validação dos dados de item
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object|InvalidArgumentException
     */
    protected function setValidateItem($dataItem)
    {
        if ((is_null($dataItem) || count($dataItem) == 0 || array_key_exists('items', $dataItem) == false) == true) {
            throw new \InvalidArgumentException('Erro ao setar o item');
        } else {
            $this->dataItem = $dataItem;
        }
    }

    /**
     * Retorna os items setados na adição
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object
     */
    public function getPaymentItems()
    {
        return $this->items;
    }

    /**
     * Verifica se o item e de um produto único ou se é um pacote de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object|array
     */
    private function setVerifyItem()
    {
        $iteratorPayments = new \RecursiveArrayIterator($this->dataItem);
        while ($iteratorPayments->valid()) {
            if ($iteratorPayments->hasChildren()) {
                $this->setChildrenItems($iteratorPayments);
            }
            $iteratorPayments->next();
        }
        array_push($this->item, $this->childrenItems);
        $this->setCreateItems();
    }

    /**
     * Insere mais de um item a requisição de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object|array
     */
    protected function setChildrenItems($iteratorPayments)
    {
        foreach ($iteratorPayments->getChildren() as $key => $value) {
            $this->childrenItems[$iteratorPayments->key()][$key] = new Item($value);
        }
    }

    /**
     * Cria o objeto de item
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object|array
     */
    private function setCreateItems()
    {
        if ((array_key_exists(0, $this->item) && array_key_exists('items', $this->item[0])) == true) {
            $this->items = $this->item[0]['items'];
        } else {
            $this->items = array();
        }
    }

    /**
     * Cria uma referencia para o seu pagamento sera utilizar para indentificar o pagamento
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object|null
     */
    public function setPaymentReference($reference = NULL)
    {
        if (!is_null($reference)) {
            $this->reference = $reference;
            return $this;
        }
    }

    /**
     * Seta a moeda a ser utilizada para o pagamento
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object|null
     */
    public function setPaymentCurrency($currency = NULL)
    {
        if (!is_null($currency)) {
            $this->currency = $currency;
            return $this;
        }
    }

    public function setPaymentShippingType($shippingType = NULL)
    {
        if (!is_null($shippingType)) {
            $this->shipping = $shippingType;
            return $this;
        }
    }
    
    public function getCurrency(){
        return $this->currency;
    }
    
    public function getShipping(){
        return $this->shipping;
    }
    /**
     * 
     * @todo Concluir a criação da lógica de separação do endereço!!!!!
     */
    public function setPaymentAddress(array $Address = null){
        if(array_key_exists('address', $Address) && !is_null($Address)){
            $this->address = new Address($Address['address']);
        }
    }
    
}
