<?php

namespace laravel\pagseguro\Http\Request\Adapter;

use laravel\pagseguro\Http\Request\RequestInterface;

/**
 * Adapter Interface
 *
 * @category   Http
 * @package    Laravel\PagSeguro\Http
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-10-28
 *
 * @copyright  Laravel\PagSeguro
 */
interface AdapterInterface
{
    /**
     * @param RequestInterface $request
     * @return boolean Successful request
     */
    public function dispatch(RequestInterface $request);

    /**
     * @return \laravel\pagseguro\Http\Response\ResponseInterface Response
     */
    public function getResponse();
}
