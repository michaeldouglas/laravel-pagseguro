<?php

/**
 * Classe responsável pela requisição
 *
 * @category   request
 * @package    Laravel\PagSeguro\Request
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 17/02/2015
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Request;

use laravel\pagseguro\Validators\ValidatorsRequest as Validators,
    laravel\pagseguro\Request\RequestInterface;

class Request implements RequestInterface
{

    use Validators;

    protected $httpPostField;
    private   $dataRequest;
    private   $_defineSizeFiel;
    private   $_contentLength;
    private   $_arguments;
    private   $_timeout;
    private   $_charset;
    protected $curl;
    protected $_optionsMethod;
    protected $_options;
    protected $_objectRequest;

    const ARGSEPARATOR = '&';

    /**
     * Para utilização das requisições é necessario que o Curl esteja ativo
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return void
     */
    public function __construct()
    {
        $this->setVerifyCurl();
    }

    /**
     * Método responsável por verificar se o Curl esta ativo para utilização da 
     * biblioteca
     * @copyright (c) 2014, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     * @return Exception|bool
     */
    private function setVerifyCurl()
    {
        if (function_exists('curl_init') === false) {
            throw new Exception('Erro não é possível encontrar a função CURL');
        }

        $this->setObjectCURL();
    }
    
    /**
     * Método responsável por iniciar o curl para a requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function setObjectCURL()
    {
        $this->curl = curl_init();
    }

    /**
     * Método responsável por iniciar a requisição de compra ao PagSeguro
     * @copyright (c) 2015, Michael Araujo
     * @access protected
     * @since 0.1
     * @param Object PaymentRequest - Contém os dados de requisição de compra
     */
    protected function sendRequest(PaymentRequest $data, $arguments)
    {
        $this->dataRequest = $data;
        $this->_setArguments($arguments)
                ->_setBuildQuery()
                ->_setSizeBuildQuery()
                ->_setContentLength()
                ->_setMethodOptions()
                ->_setOptions();
        
        $this->_request();
    }

    /**
     * Método responsável por setar os dados de envio para o objeto httpPostField
     * Gerando um string query
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setBuildQuery()
    {
        if (count($this->dataRequest) > 0) {
            $dataBuild = array_merge($this->dataRequest->credentials->__toArray(), $this->dataRequest->data);
            $this->httpPostField = http_build_query($dataBuild, '', self::ARGSEPARATOR);
            return $this;
        }

        return false;
    }
    
    /**
     * Método responsável por obter os dados de envio para no objeto httpPostField
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param void
     */
    public function getBuildQuery()
    {
        return $this->httpPostField;
    }
    
    /**
     * Método responsável por setar o tamnho da string de envio contida no 
     * objeto httpPostField
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setSizeBuildQuery()
    {
        $this->_defineSizeFiel = strlen($this->httpPostField);
        return $this;
    }
    
    /**
     * Método responsável por obter o tamnho da string de envio contida no 
     * objeto httpPostField
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param void
     */
    public function getSizeBuildQuery()
    {
        return $this->_defineSizeFiel;
    }
    
    /**
     * Método responsável por setar a string com o tamnho contido no 
     * objeto httpPostField
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setContentLength()
    {
        $this->_contentLength = "Content-length: " . $this->getSizeBuildQuery();
        return $this;
    }
    
    /**
     * Método responsável por obter a string com o tamnho contido no 
     * objeto httpPostField
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param void
     */
    public function getContentLength()
    {
        return $this->_contentLength;
    }
    
    /**
     * Método responsável por separar os argumentos contendo o TimeOut e o 
     * Charset de cabeçalho de envio
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setArguments(array $arguments = null)
    {
        $this->_arguments = $arguments;
        $this->_setSeparateArguments();
        return $this;
    }
    
    /**
     * Método responsável por verificar os argumentos e separar TimeOut e 
     * Charset
     * @copyright (c) 2015, Michael Araujo
     * @access protected
     * @since 0.1
     * @param void
     */
    protected function _setSeparateArguments()
    {
        if ($this->_verifyArgumentTimeout($this->_arguments) && $this->_verifyArgumentCharset($this->_arguments)) {//Define os argumentos
            $this->_setTimeout($this->_arguments[0])->_setCharset($this->_arguments[1]);
        } else if ($this->_verifyArgumentTimeout($this->_arguments)) {
            $this->_setTimeout($this->_arguments[0])->_setCharset();
        } else if ($this->_verifyArgumentCharset($this->_arguments)) {
            $this->_setTimeout()->_setCharset($this->_arguments[1]);
        } else {
            $this->_setTimeout()->_setCharset();
        }

        return $this;
    }
    
    /**
     * Método responsável por setar o timeout de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setTimeout($timeOut = 0)
    {
        $this->_timeout = $timeOut;
        return $this;
    }
    
    /**
     * Método responsável por obter o timeout de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param void
     */
    public function getTimeout()
    {
        return $this->_timeout;
    }
    
    /**
     * Método responsável por setar o charset de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setCharset($charset = 'ISO-8859-1')
    {
        $this->_charset = "Content-Type: application/x-www-form-urlencoded; charset={$charset}";
        return $this;
    }
    
    /**
     * Método responsável por obter o charset de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    public function getCharset()
    {
        return $this->_charset;
    }
    
    /**
     * Método responsável por setar o options de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setMethodOptions()
    {
        $this->_optionsMethod = [
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $this->httpPostField,
        ];
        
        return $this;
    }
    
    /**
     * Método responsável por obter o options de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    public function getMethodOptions()
    {
        return $this->_optionsMethod;
    }
    
    /**
     * @todo Ajustar o recebimento do parametro de URL
     */
    protected function _setOptions()
    {
        $this->_options = [
            CURLOPT_HTTPHEADER => [
                $this->_charset,
                $this->_contentLength
            ],
            CURLOPT_URL => 'https://ws.pagseguro.uol.com.br/v2/checkout',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_CONNECTTIMEOUT => $this->_timeout
        ];
        
        $this->_setRequest();
    }
    
    /**
     * Método responsável por unir os obtetos de options e optionsMethod para 
     * requisição.
     * @copyright (c) 2015, Michael Araujo
     * @access protected
     * @since 0.1
     * @param object
     */
    protected function _setRequest()
    {
        $this->_objectRequest = array_replace($this->_options, $this->_optionsMethod);
        
        return $this;
    }
    
    /**
     * Método responsável por retornar as opções setadas para a requisição.
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param object
     */
    public function getOptions()
    {
        return $this->_options;
    }
    
    /**
     * Método responsável por retornar a requisição que sera feita ao PagSeguro
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param object
     */
    public function getRequest()
    {
        return $this->_objectRequest;
    }

    /**
     * @todo Concluir as chamadas e verificações de erro
     */
    protected function _request()
    {   
        curl_setopt_array($this->curl, $this->_objectRequest);
        curl_exec($this->curl);
        
        curl_close($this->curl);
    }

}
