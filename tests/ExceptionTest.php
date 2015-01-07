<?php
use laravel\pagseguro\Payment\Payment,
    laravel\pagseguro\Payment\PaymentRequest;

class ExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Erro ao setar o item
     */
    public function testExceptionPayment()
    {
        $payment = new Payment;
        $payment->addItem($dados = array());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Erro ao setar o item
     */
    public function testExceptionPaymentKey()
    {
        $payment = new Payment;
        $payment->addItem($dados = array('teste'));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Erro ao setar o item
     */
    public function testExceptionPaymentNULL()
    {
        $payment = new Payment;
        $payment->addItem($dados = null);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamInvalid()
    {
        new laravel\pagseguro\Credentials\Credentials(123456, 'michaeldouglas010790@gmail.com');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamEmailInvalid()
    {
        new laravel\pagseguro\Credentials\Credentials('651233CECD6304779B7570BA2D06', 'teste');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamNull()
    {
        new laravel\pagseguro\Credentials\Credentials(null, null);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamTokenNull()
    {
        new laravel\pagseguro\Credentials\Credentials(null, 'michaeldouglas010790@gmail.com');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamEmailNull()
    {
        new laravel\pagseguro\Credentials\Credentials('651233CECD6304779B7570BA2D06', null);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Erro ao solicitar uma requisição de compra!
     */
    public function testExceptionPaymentRequestItemNUll()
    {
        $credentials = new laravel\pagseguro\Credentials\Credentials('65821CECD6304779B7570BA2D06AD953', 'michaeldouglas010790@gmail.com');
        $PaymentRequest = new PaymentRequest;
        $PaymentRequest->setRequest(NULL, $credentials);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Erro ao solicitar uma requisição de compra!
     */
    public function testExceptionPaymentRequestNUll()
    {
        $PaymentRequest = new PaymentRequest;
        $PaymentRequest->setRequest(NULL, NULL);
    }

}