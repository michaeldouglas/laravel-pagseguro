<?php

namespace laravel\pagseguro\Payment\Method\CreditCard;

/**
 * Payment Method Credit Card Interface
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
interface CreditCardInterface
{
    const VISA = 101;
    const MASTERCARD = 102;
    const AMERICAN_EXPRESS = 103;
    const DINERS = 104;
    const HIPERCARD = 105;
    const AURA = 106;
    const ELO = 107;
    const PLENOCARD = 108;
    const PERSONALCARD = 109;
    const JCB = 110;
    const DISCOVER = 111;
    const BRASILCARD = 112;
    const FORTBRASIL = 113;
    const CARDBAN = 114;
    const VALECARD = 115;
    const CABAL = 116;
    const MAIS = 117;
    const AVISTA = 118;
    const GRANDCARD = 119;
    const SOROCRED = 120;
}
