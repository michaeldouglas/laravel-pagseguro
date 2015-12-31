<?php

namespace laravel\pagseguro\Payment\Method\CreditCard;

use laravel\pagseguro\Payment\Method\MethodAbstract;

/**
 * Payment Method Credit Card Object
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class CreditCard extends MethodAbstract implements CreditCardInterface
{

    /**
     * @var int
     */
    protected $type = self::TYPE_CREDIT_CARD;

    /**
     * @var string
     */
    protected $typeName = 'Cartão de Crédito';

    /**
     * @var array
     */
    protected $names = [
        self::VISA => 'VISA',
        self::MASTERCARD => 'MasterCard',
        self::AMERICAN_EXPRESS => 'American Express',
        self::DINERS => 'Diners',
        self::HIPERCARD => 'Hipercard',
        self::AURA => 'Aura',
        self::ELO => 'Elo',
        self::PLENOCARD => 'PLENOCard',
        self::PERSONALCARD => 'PersonalCard',
        self::JCB => 'JCB',
        self::DISCOVER => 'Discover',
        self::BRASILCARD => 'BrasilCard',
        self::FORTBRASIL => 'FORTBRASIL',
        self::CARDBAN => 'CARDBAN',
        self::VALECARD => 'VALECARD',
        self::CABAL => 'Cabal',
        self::MAIS => 'Mais',
        self::AVISTA => 'Avista',
        self::GRANDCARD => 'GRANDCARD',
        self::SOROCRED => 'Sorocred',
    ];
}
