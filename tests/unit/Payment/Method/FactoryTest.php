<?php

namespace laravel\pagseguro\Tests\Unit\Payment\Method;

use laravel\pagseguro\Payment\Method\MethodInterface;
use laravel\pagseguro\Payment\Method\MethodFactory;
use laravel\pagseguro\Payment\Method\Billet\BilletInterface;
use laravel\pagseguro\Payment\Method\CreditCard\CreditCardInterface;
use laravel\pagseguro\Payment\Method\DepositAccount\DepositAccountInterface;
use laravel\pagseguro\Payment\Method\Extras\ExtrasInterface;
use laravel\pagseguro\Payment\Method\Transfer\TransferInterface;

/**
 * Payment Method Factory Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class NotificationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Unknow type
     * @expectedException \InvalidArgumentException
     */
    public function testUnknowType()
    {
        MethodFactory::factory(1500, CreditCardInterface::VISA);
    }

    /**
     * Unknow code
     * @expectedException \InvalidArgumentException
     */
    public function testUnknowCode()
    {
        MethodFactory::factory(MethodInterface::TYPE_CREDIT_CARD, 12);
    }

    /**
     * Credit Card
     */
    public function testCreditCard()
    {
        $method = MethodFactory::factory(
            MethodInterface::TYPE_CREDIT_CARD,
            CreditCardInterface::VISA
        );
        $className = '\laravel\pagseguro\Payment\Method\CreditCard\CreditCardInterface';
        $this->assertInstanceOf($className, $method);
        $this->assertEquals(MethodInterface::TYPE_CREDIT_CARD, $method->getType());
        $this->assertEquals(CreditCardInterface::VISA, $method->getCode());
        $this->assertEquals('Cartão de Crédito', $method->getTypeName());
        $this->assertEquals('VISA', $method->getName());
        $this->assertEquals('Cartão de Crédito VISA', $method->getFullName());
    }

    /**
     * Billet
     */
    public function testBillet()
    {
        $method = MethodFactory::factory(
            MethodInterface::TYPE_BILLET,
            BilletInterface::BRADESCO
        );
        $className = '\laravel\pagseguro\Payment\Method\Billet\BilletInterface';
        $this->assertInstanceOf($className, $method);
        $this->assertEquals(MethodInterface::TYPE_BILLET, $method->getType());
        $this->assertEquals(BilletInterface::BRADESCO, $method->getCode());
        $this->assertEquals('Boleto', $method->getTypeName());
        $this->assertEquals('Bradesco', $method->getName());
        $this->assertEquals('Boleto Bradesco', $method->getFullName());
    }

    /**
     * Transfer
     */
    public function testTransfer()
    {
        $method = MethodFactory::factory(
            MethodInterface::TYPE_TRANSFER,
            TransferInterface::HSBC
        );
        $className = '\laravel\pagseguro\Payment\Method\Transfer\TransferInterface';
        $this->assertInstanceOf($className, $method);
        $this->assertEquals(MethodInterface::TYPE_TRANSFER, $method->getType());
        $this->assertEquals(TransferInterface::HSBC, $method->getCode());
        $this->assertEquals('Transferência eletrônica', $method->getTypeName());
        $this->assertEquals('HSBC', $method->getName());
        $this->assertEquals('Transferência eletrônica HSBC', $method->getFullName());
    }

    /**
     * PagSeguro Credits
     */
    public function testPsCredit()
    {
        $method = MethodFactory::factory(
            MethodInterface::TYPE_PS_CREDIT,
            ExtrasInterface::PS_CREDIT
        );
        $className = '\laravel\pagseguro\Payment\Method\Extras\ExtrasInterface';
        $this->assertInstanceOf($className, $method);
        $this->assertEquals(MethodInterface::TYPE_PS_CREDIT, $method->getType());
        $this->assertEquals(ExtrasInterface::PS_CREDIT, $method->getCode());
        $this->assertEquals('Saldo PagSeguro', $method->getTypeName());
        $this->assertNull($method->getName());
        $this->assertEquals('Saldo PagSeguro', $method->getFullName());
    }

    /**
     * Oi Paggo
     */
    public function testOiPaggo()
    {
        $method = MethodFactory::factory(
            MethodInterface::TYPE_OI_PAGGO,
            ExtrasInterface::OI_PAGGO
        );
        $className = '\laravel\pagseguro\Payment\Method\Extras\ExtrasInterface';
        $this->assertInstanceOf($className, $method);
        $this->assertEquals(MethodInterface::TYPE_OI_PAGGO, $method->getType());
        $this->assertEquals(ExtrasInterface::OI_PAGGO, $method->getCode());
        $this->assertEquals('Oi Paggo', $method->getTypeName());
        $this->assertNull($method->getName());
        $this->assertEquals('Oi Paggo', $method->getFullName());
    }

    /**
     * Deposit Account
     */
    public function testDepositAccount()
    {
        $method = MethodFactory::factory(
            MethodInterface::TYPE_DEPOSIT_ACCOUNT,
            DepositAccountInterface::BANCO_DO_BRASIL
        );
        $className = '\laravel\pagseguro\Payment\Method\DepositAccount\DepositAccountInterface';
        $this->assertInstanceOf($className, $method);
        $this->assertEquals(MethodInterface::TYPE_DEPOSIT_ACCOUNT, $method->getType());
        $this->assertEquals(DepositAccountInterface::BANCO_DO_BRASIL, $method->getCode());
        $this->assertEquals('Depósito em conta', $method->getTypeName());
        $this->assertEquals('Banco do Brasil', $method->getName());
        $this->assertEquals('Depósito em conta Banco do Brasil', $method->getFullName());
    }
}
