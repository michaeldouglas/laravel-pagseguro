<?php

namespace laravel\pagseguro\Http\Response\Parser;

/**
 * Response Parser Interface
 *
 * @category   Http
 * @package    Laravel\PagSeguro\Http\Response\Parser
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
interface ParserInterface
{

    /**
     * Constructor
     * @param string $rawData
     */
    public function __construct($rawData);

    /**
     * Array Parse
     */
    public function toArray();

}
