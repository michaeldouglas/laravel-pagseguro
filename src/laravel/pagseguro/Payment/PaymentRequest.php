<?php

/**
 * Classe responsável por centralizar a requisição de compra
 *
 * @category   PaymentRequest
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 02/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Payment;

use laravel\pagseguro\Payment\Payment,
    laravel\pagseguro\Credentials\Credentials;

class PaymentRequest extends Payment
{

    private $dataPaymentRequest;
    
    /**
     * Verifica se os dados de credencial da loja foram obtidos no config da Laravel PagSeguro
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return void
     * @expectedException Exception
     */
    public function __construct(Credentials $credentials = null)
    {
        if ( ($credentials instanceof Credentials) === FALSE){
            throw new \Exception('Erro ao credenciar a loja!');
        }else{
            return parent::__construct();
        }
    }

   /**
     * Verifica se os dados de requisição de compra estão corretos e se os objeto
     * de credencial foi fornecido como parametro
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|array|Exception
     */
    public function setRequest(array $dataPaymentRequest = NULL)
    {
        if (!is_null($dataPaymentRequest) && is_array($dataPaymentRequest))
        {
            $this->dataPaymentRequest = $dataPaymentRequest;
            $this->setCreatePaymentRequest();
        } else {
            throw new \Exception('Erro ao solicitar uma requisição de compra!');
        }
    }

    /**
     * Cria a requisição de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|array
     */
    public function setCreatePaymentRequest()
    {
        $this
            ->setCurrency('BRL')
            ->setReference('REF1')
            ->setShippingType(1)
            ->setAddress($this->dataPaymentRequest)
            ->setSender($this->dataPaymentRequest)
            ->addItem($this->dataPaymentRequest);
    }

    /**
     * Retorna os items setados na adição
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object
     */
    public function getPaymentItems()
    {
        return parent::getPaymentItems();
    }

}
