<?php
class ExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Erro ao setar o item
     */
    public function testExceptionPayment()
    {
        $payment = new laravel\pagseguro\Payment;
        $payment->setAddItem($dados = array());
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Erro ao setar o item
     */
    public function testExceptionPaymentKey()
    {
        $payment = new laravel\pagseguro\Payment;
        $payment->setAddItem($dados = array('teste'));
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Erro ao setar o item
     */
    public function testExceptionPaymentNULL()
    {
        $payment = new laravel\pagseguro\Payment;
        $payment->setAddItem($dados = null);
    }
}