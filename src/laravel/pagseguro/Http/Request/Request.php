<?php

namespace laravel\pagseguro\Http\Request;

use laravel\pagseguro\Http\Request\Adapter\AdapterInterface;

/**
 * Request Object
 *
 * @category   Http
 * @package    Laravel\PagSeguro\Http
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-10-28
 *
 * @copyright  Laravel\PagSeguro
 */
class Request implements RequestInterface
{

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var array|\JsonSerializable
     */
    protected $params = [];

    /**
     * @var int
     */
    protected $timeout = 10;

    /**
     * @var string
     */
    protected $charset = 'utf-8';

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @param AdapterInterface|null $adapter
     */
    public function __construct(AdapterInterface $adapter = null)
    {
        if (!is_null($adapter)) {
            $this->setAdapter($adapter);
        }
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param AdapterInterface $adapter
     * @return RequestInterface
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed|string
     */
    public function getData()
    {
        if (!empty($this->data)) {
            return $this->data;
        }
        $data = $this->getParams();
        if ($data instanceof \JsonSerializable) {
            return json_encode($data);
        }
        return http_build_query($data);
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $method
     * @return RequestInterface
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
        return $this;
    }

    /**
     * @param string $url
     * @return RequestInterface
     */
    public function setUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid URL');
        }
        $this->url = $url;
        return $this;
    }

    /**
     * @param array|\JsonSerializable $params
     * @return RequestInterface
     */
    public function setParams($params)
    {
        if (!is_array($params) && !($params instanceof \JsonSerializable)) {
            throw new \InvalidArgumentException('Invalid Params Format');
        }
        $this->params = $params;
        return $this;
    }

    /**
     * @param string $data
     * @return RequestInterface
     */
    public function setData($data)
    {
        if (!is_null($data) && !is_string($data)) {
            throw new \InvalidArgumentException('Invalid data');
        }
        $this->data = $data;
        return $this;
    }

    /**
     * @param int $timeout
     * @return RequestInterface
     */
    public function setTimeout($timeout)
    {
        if (!filter_var($timeout, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException('Invalid timeout');
        }
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @param string $charset
     * @return RequestInterface
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @param array $headers
     * @return RequestInterface
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return bool|\laravel\pagseguro\Http\Response\ResponseInterface
     * FALSE on failure
     */
    protected function send($name, $arguments)
    {
        if (count($arguments) < 1) {
            throw new \InvalidArgumentException('Unknown URL');
        }
        $this->setMethod($name);
        $this->setUrl(array_shift($arguments));
        if (count($arguments)) {
            $this->setParams($arguments[0]);
        }
        $adapter = $this->getAdapter();
        if (is_null($adapter)) {
            throw new \RuntimeException('Adapter is Required');
        }
        return $adapter->dispatch($this) ? $adapter->getResponse() : false;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return bool|\laravel\pagseguro\Http\Response\ResponseInterface
     */
    public function __call($name, $arguments)
    {
        $method = strtoupper($name);
        if (in_array($method, ['GET', 'POST', 'PUT', 'DELETE'])) {
            return $this->send($method, $arguments);
        }
        throw new \BadMethodCallException('Unsupported method: ' . $method);
    }
}
