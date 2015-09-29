<?php

namespace laravel\pagseguro\Http\Request;

/**
 * Request Interface
 *
 * @category   Http
 * @package    Laravel\PagSeguro\Http
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-10-28
 *
 * @copyright  Laravel\PagSeguro
 */
interface RequestInterface
{
    /**
     * @return string GET|POST|PUT|DELETE ...
     */
    public function getMethod();

    /**
     * @return string Complete URL
     */
    public function getUrl();

    /**
     * @return array
     */
    public function getParams();

    /**
     * @return array
     */
    public function getData();

    /**
     * @return integer
     */
    public function getTimeout();

    /**
     * @return string
     */
    public function getCharset();

    /**
     * @return array Associative
     */
    public function getHeaders();
}