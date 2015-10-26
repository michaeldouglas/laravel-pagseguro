<?php

namespace laravel\pagseguro\Request;

/**
 * Classe responsável por centralizar a requisição de compra
 *
 * @category   PaymentRequest
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 22/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */
use laravel\pagseguro\Payment\Payment,
    laravel\pagseguro\Credentials\Credentials,
    laravel\pagseguro\Validators\ValidatorsRequest as Validators,
    laravel\pagseguro\Facades\PagSeguroFacade as PagSeguro,
    laravel\pagseguro\Request\Request;

class PaymentRequest extends Payment
{

    use Validators;

    /**
     *
     * @var object contém os dados de credencial da loja
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
        $this->credentials = $credentials;
        $this->request     = new Request;
    }

    /**
     * Cria a requisição de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|array
     */
    public function setRequest(array $data)
    {
        if ($this->setobjectdata($data)) {
            $this->setFacadeAddress()->setCredentials($this->credentials)->setFacadeCollection()->setSender($this->data);
            return $this;
        }

        return false;
    }

    /**
     * Cria o objeto com os dados de requisição de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object|array
     */
    private function setobjectdata(array $data = null)
    {
        if ($this->_dataIsValid($data)) {
            $this->data = $data;
            return true;
        }

        return false;
    }

    /**
     * Cria o objeto com os dados de endereço
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object
     */
    private function setFacadeAddress()
    {
        if ($this->_dataAddressIsValid($this->data)) {
            $this->setAddress(PagSeguro::createAddress($this->data['address']));
        }

        return $this;
    }

    /**
     * Cria o objeto com os dados de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object
     */
    private function setFacadeCollection()
    {
        if ($this->_dataCollectionIsValid($this->data)) {
            $this->setItemCollectionFromArray($this->data['items']);
        }

        return $this;
    }
    
    /**
     * Método para sobrecarga de requisição
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return object
     */
    public function __call($name, $arguments = [])
    {
        if (method_exists($this->request, $name)) {
            return $this->request->$name($this, $arguments);
        }
        
        return false;
    }
}
