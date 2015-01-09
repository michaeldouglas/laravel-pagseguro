<?php
use laravel\pagseguro\Payment\Payment,
    laravel\pagseguro\Payment\PaymentRequest,
    laravel\pagseguro\Credentials\Credentials;

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
        $this->setExpectedException(
            '\InvalidArgumentException',
            Credentials::ERROR_INVALID_TOKEN
        );
        new Credentials(123456, 'michaeldouglas010790@gmail.com');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamEmailInvalid()
    {
        $this->setExpectedException(
            '\InvalidArgumentException',
            Credentials::ERROR_INVALID_EMAIL
        );
        new Credentials('651233CECD6304779B7570BA2D06', 'teste');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamNull()
    {
        $this->setExpectedException(
            '\InvalidArgumentException',
            Credentials::ERROR_INVALID_TOKEN
        );
        new Credentials(null, null);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamTokenNull()
    {
        $this->setExpectedException(
            '\InvalidArgumentException',
            Credentials::ERROR_INVALID_TOKEN
        );
        new Credentials(null, 'michaeldouglas010790@gmail.com');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dados de credencial inválidos!
     */
    public function testExceptionCredentialParamEmailNull()
    {
        $this->setExpectedException(
            '\InvalidArgumentException',
            Credentials::ERROR_INVALID_EMAIL
        );
        new Credentials('651233CECD6304779B7570BA2D06', null);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Erro ao credenciar a loja!
     */
    public function testExceptionPaymentRequestItemNUll()
    {
        $credentials = new Credentials('65821CECD6304779B7570BA2D06AD953', 'michaeldouglas010790@gmail.com');
        $PaymentRequest = new PaymentRequest;
        $PaymentRequest->setRequest(NULL, $credentials);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Erro ao credenciar a loja!
     */
    public function testExceptionPaymentRequestNUll()
    {
        $PaymentRequest = new PaymentRequest;
        $PaymentRequest->setRequest(NULL, NULL);
    }

}