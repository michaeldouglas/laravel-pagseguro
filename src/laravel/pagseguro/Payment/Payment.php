<?php

namespace laravel\pagseguro\Payment;

use laravel\pagseguro\Credentials\Credentials,
    laravel\pagseguro\Address\Address,
    laravel\pagseguro\Item\Item,
    laravel\pagseguro\Item\ItemCollection,
    laravel\pagseguro\Request\Request,
    laravel\pagseguro\Sender\Sender;

/**
 * Classe responsável por prover uma solicitação de pagamento
 *
 * @category   Payment
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2014-12-30
 *
 * @copyright  Laravel\PagSeguro
 */
class Payment extends Request
{

    /**
     * @var array
     */
    protected $dataItem;

    /**
     * @var string
     */
    private $reference = 'REF1';

    /**
     * @var string
     */
    private $currency = 'BRL';

    /**
     * @var int
     */
    private $shipping = 1;

    /**
     * @var ItemCollection
     */
    protected $items;

    /**
     * @var Address
     */
    protected $address;

    /**
     * @var array
     */
    protected $sender;

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * Verifica se os dados de credencial da loja foram obtidos no config da Laravel PagSeguro
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return void
     * @expectedException Exception
     */
    public function __construct(Credentials $credentials = null)
    {
        $this->items = new ItemCollection([]);
        if(!is_null($credentials)) {
            $this->setCredentials($credentials);
        }
        parent::__construct();
    }

    /**
     * Set Credentials
     * @param Credentials $credentials
     * @return PaymentRequest
     */
    public function setCredentials(Credentials $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * Irá verificar se os dados de item fornecidos estão válidos e também
     * se no item contém mais de uma requisição de compra
     * @param Item $item
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return Payment
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Set Item Collection (Set itens da requisição de pagamento)
     * @param ItemCollection $itemCollection
     * @author Isaque de Souza <isaquesb@gmail.com>
     * @return Payment
     */
    public function setItemCollection(ItemCollection $itemCollection)
    {
        $this->items = $itemCollection;
        return $this;
    }

    /**
     * Set Item Collection From Array Type (Set itens da requisição de pagamento)
     * @param array $itemCollection
     * @author Isaque de Souza <isaquesb@gmail.com>
     * @return Payment
     */
    public function setItemCollectionFromArray(array $itemCollection)
    {
        $collection = ItemCollection::factory($itemCollection);
        $this->setItemCollection($collection);
        return $this;
    }

    /**
     * Get Items
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Cria uma referencia para o seu pagamento sera utilizar para indentificar o pagamento
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|null
     */
    public function setReference($reference = NULL)
    {
        if (!is_null($reference)) {
            $this->reference = $reference;
        }
        return $this;
    }

    /**
     * Seta a moeda a ser utilizada para o pagamento
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|null
     */
    public function setCurrency($currency = NULL)
    {
        if (!is_null($currency)) {
            $this->currency = $currency;
        }
        return $this;
    }

    /**
     * Seta a forma de envio do produto, por exemplo: SEDEX = 1
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|null
     */
    public function setShippingType($shippingType = NULL)
    {
        if (!is_null($shippingType)) {
            $this->shipping = $shippingType;
        }
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Obtém a forma de envio
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set Paymento Address (Seta endereço)
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @param Address $address
     * @return Payment
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Obtém o endereço de envio do pagamento
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Cria o objeto de remetente de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object
     */
    public function setSender(array $sender = NULL){
        if (
            array_key_exists('sender', $sender)
            && !is_null($sender)
        ) {
            $this->sender = new Sender($sender['sender']);
        }
        return $this;
    }

    /**
     * Obtém o remetente da compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object
     */
    public function getSender()
    {
        return $this->sender;
    }

}
