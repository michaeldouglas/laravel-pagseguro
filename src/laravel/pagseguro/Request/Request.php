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

use laravel\pagseguro\Validators\ValidatorsRequest as Validators;
use laravel\pagseguro\Request\RequestInterface;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\DataRequestHydrator;
<<<<<<< HEAD
use laravel\pagseguro\Proxy\Proxy;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Error\LaravelError;
=======
>>>>>>> f3996ffdf95ea049a186cf3e2461383ae898fa9c
use laravel\pagseguro\Remote\Url\Resolver;

class Request implements RequestInterface
{

    use Validators, DataHydratorTrait, DataRequestHydrator;

    protected $httpPostField;
    private   $dataRequest;
    public    $code;
    private   $_defineSizeFiel;
    private   $_contentLength;
    private   $_arguments;
    private   $_timeout = 0;
    private   $_charset = 'ISO-8859-1';
    private   $_url;
    protected $curl;
    protected $_optionsMethod;
    protected $_options;
    protected $_objectRequest;
    const ARGSEPARATOR = '&';
    
    public function getValidationRules(){}

    /**
     * Cria o objeto curl para requisição
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return void
     */
    public function __construct()
    {
        $this->curl = (new Proxy('laravelpagseguro.proxy'))->getCurl();
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
        $this->_setArguments($arguments)->_setBuildQuery()->_setSizeBuildQuery()
        ->_setContentLength()->_setMethodOptions()->_setOptions();
        
        return $this->_request();
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
            $dataBuild = array_merge($this->dataRequest->credentials->__toArray(), $this->separatorDataRequest($this->dataRequest));
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
        $this->_arguments = ( array_key_exists(0, $arguments) ? $arguments[0] : NULL );
        if(!is_null($this->_arguments)){
            $this->_setSeparateArguments();
        }
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
        $this->_hydrate($this->_arguments, '_set');
        return $this;
    }
    
    /**
     * Método responsável por setar o timeout de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param void
     */
    private function _setTimeout($timeOut)
    {
        if(!$this->_verifyArgumentTimeout($timeOut)){
            $timeOut = $this->_timeout;
        }
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
    private function _setCharset($charset)
    {
        if(!$this->_verifyArgumentCharset($charset)){
            $charset = $this->_charset;
        }
        $this->_charset = $charset;
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
     * Método responsável por obter a string charset para a requisição
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param string contem a header para requisicao e tambem o tipo que o dado
     * sera retornando
     */
    public function getStringCharset()
    {
        return "Content-Type: application/x-www-form-urlencoded; charset={$this->_charset}";
    }
    
    /**
     * Método responsável por setar a URL de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access private
     * @since 0.1
     * @param object seta  a URL
     */
    private function _setURL($url)
    {
        if(!$this->_verifyURL($url)){
            $url = $this->_url;
        }
        $this->_url = $url;
        return $this;
    }
    
    /**
     * Método responsável por obter a URL de requisição
     * @copyright (c) 2015, Michael Araujo
     * @access public
     * @since 0.1
     * @param object contendo a url
     */
    public function getURL()
    {
        return $this->_url;
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
     * Método responsável por setar os dados de opção de para o envio da
     * requisição.
     * @copyright (c) 2015, Michael Araujo
     * @access protected
     * @since 0.1
     * @param object
     */
    protected function _setOptions()
    {
        $this->_options = [
            CURLOPT_HTTPHEADER => [
                $this->getStringCharset(),
                $this->_contentLength
            ],
            CURLOPT_URL => $this->getConfigUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_CONNECTTIMEOUT => $this->_timeout
        ];
        
        $this->_setRequest();
    }

    /**
     * @return string URL
     */
    protected function getConfigUrl()
    {
        $urlResolver = new Resolver();
        return $urlResolver->getByKey('checkout');
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
        $result = curl_exec($this->curl);
        
        (new LaravelError($result))->verifyUser();
        
        $xml = simplexml_load_string($result);
        
        (new LaravelError($xml))->verifyErrors()->ExceptionError();
        
        $error = curl_errno($this->curl);
        
        if($error){
            $errorMessage = curl_error($this->curl);
            throw new Exception("Erro: $errorMessage");
        }
        
        curl_close($this->curl);
        
        $this->setCode($xml->code);
    }
    
    private function setCode( $code )
    {
        $this->code = $code;
    }
    
    public function getCode()
    {
        return $this->code;
    }
    
}
