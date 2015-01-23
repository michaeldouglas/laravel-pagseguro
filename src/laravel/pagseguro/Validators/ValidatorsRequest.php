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
        return ((is_array($data) && !is_null($data)) ? true : false);
    }
    
    /**
     * Verifica se o array com os dados é válido. E se contém na compra um endereço de compra
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _dataAddressIsValid($data){
        return ((is_array($data) && !is_null($data) && array_key_exists('address', $data)) ? true : false);
    }
    
    /**
     * Verifica se o array com os dados é válido. E se existe o item a ser comprado
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function _dataCollectionIsValid($data){
        return ((is_array($data) && !is_null($data) && array_key_exists('items', $data)) ? true : false);
    }
}
