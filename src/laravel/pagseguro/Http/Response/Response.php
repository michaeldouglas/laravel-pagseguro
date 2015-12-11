<?php

namespace laravel\pagseguro\Http\Response;

/**
 * Response Object
 *
 * @category   Http
 * @package    Laravel\PagSeguro\Http
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-10-28
 *
 * @copyright  Laravel\PagSeguro
 */
class Response implements ResponseInterface
{
    /**
     * @var string
     */
    protected $rawBody;

    /**
     * @var int
     */
    protected $httpStatus;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @return string
     */
    public function getRawBody()
    {
        return $this->rawBody;
    }

    /**
     * @return int
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $rawBody
     * @return ResponseInterface
     */
    public function setRawBody($rawBody)
    {
        $this->rawBody = $rawBody;
        return $this;
    }

    /**
     * @param int $httpStatus
     * @return ResponseInterface
     */
    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }

    /**
     * @param array $errors
     * @return ResponseInterface
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
        return $this;
    }
}
