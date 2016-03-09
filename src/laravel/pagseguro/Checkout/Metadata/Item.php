<?php

namespace laravel\pagseguro\Checkout\Metadata;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;

/**
 * Metadata Item
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class Item implements TagableInterface
{

    const KEY_PASSENGER_CPF = 'PASSENGER_CPF';
    const KEY_PASSENGER_NAME = 'PASSENGER_NAME';
    const KEY_PASSENGER_PASSPORT = 'PASSENGER_PASSPORT';
    const KEY_ORIGIN_AIRPORT_CODE = 'ORIGIN_AIRPORT_CODE';
    const KEY_ORIGIN_CITY = 'ORIGIN_CITY';
    const KEY_DESTINATION_AIRPORT_CODE = 'DESTINATION_AIRPORT_CODE';
    const KEY_DESTINATION_CITY = 'DESTINATION_CITY';
    const KEY_GAME_NAME = 'GAME_NAME';
    const KEY_PLAYER_ID = 'PLAYER_ID';
    const KEY_TIME_IN_GAME_DAYS = 'TIME_IN_GAME_DAYS';
    const KEY_MOBILE_NUMBER = 'MOBILE_NUMBER';

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $value;

    use DataHydratorTrait, DataHydratorProtectedTrait, DataHydratorConstructorTrait {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array|string $data Item data
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        $data = null;
        $this->hydrateMagic(
            ['key', 'value'],
            $args
        );
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string|array Array on groups
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $key
     */
    protected function setKey($key)
    {
        if (empty($key) || !is_string($key)) {
            throw new \InvalidArgumentException('Invalid string key');
        }
        $this->key = $key;
    }

    /**
     * @param string $value
     */
    protected function setValue($value)
    {
        if (empty($value) || !is_string($value) && !is_numeric($value)) {
            throw new \InvalidArgumentException('Invalid string value');
        }
        if (mb_strlen($value) > 100) {
            throw new \InvalidArgumentException('String value > 100 chars');
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toXmlTag()
    {
        $str = <<<XML
        <item>
            <key>%s</key>
            <value>%s</value>
        </item>
XML;
        return sprintf($str, $this->getKey(), $this->getValue());
    }
}
