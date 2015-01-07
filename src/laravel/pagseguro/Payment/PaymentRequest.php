<?php

/**
 * Classe responsável por centralizar a requisição de compra
 *
 * @category   PaymentRequest
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 02/01/2015ß
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
     * Verifica se os dados de requisição de compra estão corretos e se os objeto
     * de credencial foi fornecido como parametro
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|array|Exception
     */
    public function setRequest(
        array $dataPaymentRequest = NULL,
        Credentials $credentials = null)
    {
        if (
            !is_null($dataPaymentRequest)
            && is_array($dataPaymentRequest)
            && ($credentials instanceof Credentials)
        ) {
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

}
