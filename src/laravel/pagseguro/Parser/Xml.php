<?php

namespace laravel\pagseguro\Parser;

/**
 * Parser Xml
 *
 * @category   Http
 * @package    Laravel\PagSeguro\Parser
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Xml implements ParserInterface
{

    /**
     * Raw Data
     * @var string
     */
    protected $rawData;

    /**
     * Parsed Data
     * @var array
     */
    protected $data;

    /**
     * Constructor
     * @param string $rawData
     */
    public function __construct($rawData)
    {
        if (!is_string($rawData)) {
            throw new \InvalidArgumentException('Invalid raw data');
        }
        $this->rawData = $rawData;
    }

    /**
     * Parse data
     * @throws \RuntimeException
     */
    protected function parse()
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->rawData, '\SimpleXMLElement');
        if (count(libxml_get_errors())) {
            $errors = [];
            foreach (libxml_get_errors() as $error) {
                $errors[] = $error->message;
            }
            throw new \RuntimeException('Error: '. implode("\n", $errors));
        }
        if (!$xml) {
            throw new \RuntimeException('Invalid XML data');
        }
        $this->data = json_decode(json_encode((array) $xml), true);
    }

    /**
     * Array Parse
     * @return array
     */
    public function toArray()
    {
        if (is_null($this->data)) {
            $this->parse();
        }
        if (!is_array($this->data)) {
            throw new \RuntimeException('Error on parse XML data');
        }
        return $this->data;
    }
}
