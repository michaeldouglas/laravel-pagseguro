<?php

namespace laravel\pagseguro\Payment\Method;

/**
 * Payment Method Factory
 *
 * @category   Payment
 * @package    Laravel\PagSeguro\Payment
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class MethodFactory extends MethodAbstract
{

    /**
     * Class Map
     * @var array
     */
    protected static $classMap = [
        MethodInterface::TYPE_CREDIT_CARD => '\laravel\pagseguro\Payment\Method\CreditCard\CreditCard',
        MethodInterface::TYPE_BILLET => '\laravel\pagseguro\Payment\Method\Billet\Billet',
        MethodInterface::TYPE_TRANSFER => '\laravel\pagseguro\Payment\Method\Transfer\Transfer',
        MethodInterface::TYPE_PS_CREDIT => '\laravel\pagseguro\Payment\Method\Extras\Extras',
        MethodInterface::TYPE_OI_PAGGO => '\laravel\pagseguro\Payment\Method\Extras\Extras',
        MethodInterface::TYPE_DEPOSIT_ACCOUNT => '\laravel\pagseguro\Payment\Method\DepositAccount\DepositAccount'
    ];

    /**
     * Factory Method
     * @param int $type
     * @param int $code
     * @return MethodInterface
     */
    public static function factory($type, $code)
    {
        if (!filter_var($type, FILTER_VALIDATE_INT)
            || !array_key_exists($type, self::$classMap)) {
            throw new \InvalidArgumentException('Invalid type');
        }
        if (!filter_var($code, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException('Invalid code');
        }
        $class = self::$classMap[$type];
        $paymentMethod = new $class($type, $code);
        return $paymentMethod;
    }
}
