<?php

namespace laravel\pagseguro\Validators;

/**
 * responsável por validação dos dados de requisição de compra
 *
 * @category   Validators
 * @package    Laravel\PagSeguro
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 22/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */

trait ValidatorsRequest {
    
    /**
     * Verifica se o array com os dados é válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _dataIsValid($data){
        return ((count($data) > 0 && is_array($data) && !is_null($data)) ? true : false);
    }
    
    /**
     * Verifica se o array com os dados é válido. E se contém na compra um endereço de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _dataAddressIsValid($data){
        return ((count($data) > 0 && is_array($data) && !is_null($data) && array_key_exists('address', $data)) ? true : false);
    }
    
    /**
     * Verifica se o array com os dados é válido. E se existe o item a ser comprado
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _dataCollectionIsValid($data){
        return ((count($data) > 0 && is_array($data) && !is_null($data) && array_key_exists('items', $data)) ? true : false);
    }
    
    /**
     * Verifica se o timeout é válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _verifyArgumentTimeout($data)
    {
        return ( (is_int($data) && !is_null($data) ) ? true : false);
    }
    
    /**
     * Verifica se o charset é válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _verifyArgumentCharset($data)
    {
        return ( (strlen($data) > 0 && $data != ' ' && !is_null($data) ) ? true : false);
    }
    
    /**
     * Verifica se a URL é válida
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _verifyURL($data)
    {
        return (filter_var($data, FILTER_VALIDATE_URL ) ? true : false);
    }
}
