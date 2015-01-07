<?php

/**
 * Classe responsável pela requisição
 *
 * @category   request
 * @package    Laravel\PagSeguro\Request
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 30/12/2014
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Request;

class Request
{

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
    }
}