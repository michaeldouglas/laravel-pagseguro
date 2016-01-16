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

use laravel\pagseguro\Proxy\Proxy;

class SessionPaymentRequest
{
	private   $_url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions';
	protected $httpPostField;
	const ARGSEPARATOR = '&';
	private   $_timeout = 30;
	
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
				CURLOPT_URL => $this->_url,
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
	 * Método responsável receber o comando do usuário
	 * requisição.
	 * @copyright (c) 2015, Michael Araujo
	 * @access protected
	 * @since 0.1
	 * @param object
	 */
	
	public function sessionpayment($email, $token)
	{
		$credentials = ["token" => $token, "email" => $email];
		$this->httpPostField = http_build_query($credentials, '', self::ARGSEPARATOR);
		
		$this->_setMethodOptions()->_setOptions();
		
		return $this->_request();
	}
	
	/**
	 * Método responsável por requisitar a sessão
	 * requisição.
	 * @copyright (c) 2015, Michael Araujo
	 * @access protected
	 * @since 0.1
	 * @param object
	 */
	protected function _request()
	{
		curl_setopt_array($this->curl, $this->_objectRequest);
		$result = curl_exec($this->curl);
		
		return $result;
	}
}