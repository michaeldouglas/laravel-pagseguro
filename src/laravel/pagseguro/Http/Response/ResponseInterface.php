<?php

namespace laravel\pagseguro\Http\Response;

/**
 * Response Interface
 *
 * @category   Http
 * @package    Laravel\PagSeguro\Http
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-10-28
 *
 * @copyright  Laravel\PagSeguro
 */
interface ResponseInterface
{
    /**
     * @return string Raw Body
     */
    public function getRawBody();

    /**
     * @return integer HTTP Status
     */
    public function getHttpStatus();

    /**
     * @param string $body Raw Body
     */
    public function setRawBody($body);

    /**
     * @param integer $status HTTP Status
     */
    public function setHttpStatus($status);
}
