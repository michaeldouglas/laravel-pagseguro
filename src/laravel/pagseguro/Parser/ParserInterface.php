<?php

namespace laravel\pagseguro\Parser;

/**
 * Parser Interface
 *
 * @category   Parser
 * @package    Laravel\PagSeguro\Parser
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
