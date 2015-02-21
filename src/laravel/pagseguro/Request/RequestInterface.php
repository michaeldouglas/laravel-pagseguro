<?php

namespace laravel\pagseguro\Request;

/**
 * Item Interface
 *
 * @category   Item
 * @package    Laravel\PagSeguro\Request
 *
 * @author     Isaque de Souza <michaeldouglas010790@gmail.com>
 * @since      2015-02-20
 *
 * @copyright  Laravel\PagSeguro
 */
interface RequestInterface
{
    /**
     * Get String http bulid query request
     * @return string
     */
    public function getBuildQuery();
    
    /**
     * Get size string bulid query
     * @return int
     */
    public function getSizeBuildQuery();
    
    /**
     * Get string size content request
     * @return string
     */
    public function getContentLength();
    
    /**
     * Get timeout request
     * @return string
     */
    public function getTimeout();
    
    /**
     * Get charset return response
     * @return string
     */
    public function getCharset();
    
    /**
     * Get options request
     * @return string
     */
    public function getOptions();
}