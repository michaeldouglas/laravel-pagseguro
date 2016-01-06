<?php

use laravel\pagseguro\Request\PaymentRequest,
    laravel\pagseguro\Credentials\Credentials;

/**
 * PaymentRequest Test
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @covers laravel\pagseguro\Request\PaymentRequest
 * @covers laravel\pagseguro\Credentials\Credentials
 */
class PaymentRequestTest extends PHPUnit_Framework_TestCase
{

    public $objectPaymentRequest;
    public $credentials;
    public $dataTest;

    public function setUp()
    {
        $this->credentials = new Credentials('65821CECD6304779B7570BA2D06AD953', 'michaeldouglas010790@gmail.com');
        $this->objectPaymentRequest = new PaymentRequest($this->credentials);
    }

    public function testSendRequest()
    {
        $this->assertInstanceOf('laravel\pagseguro\Request\PaymentRequest', $this->objectPaymentRequest);
    }

    public function testSetobjectdata()
    {
        $this->assertEquals(false, $this->objectPaymentRequest->setRequest([]));
    }

    public function testDataItems()
    {
        $this->dataTest = ['items' => ['item1' => ['id' => '0001', 'description' => 'Notebook Prata 1', 'quantity' => '1', 'amount' => '10.00', 'weight' => '1000', 'shippingCost' => null]]];
        $this->objectPaymentRequest->setRequest($this->dataTest);
        $this->assertArrayHasKey('items', $this->objectPaymentRequest->data);
    }

    public function testDataAddress()
    {
        $this->dataTest = ['address' => ['postalCode' => '04433130', 'street' => 'Rua benjamin vieira da silva', 'number' => '1077', 'complement' => '', 'district' => 'Centro', 'city' => 'São Paulo', 'state' => 'SP', 'country' => 'BRA',]];
        $this->objectPaymentRequest->setRequest($this->dataTest);
        $this->assertArrayHasKey('address', $this->objectPaymentRequest->data);
    }

    public function testDataSender()
    {
        $this->dataTest = ['sender' => ['name' => 'Teste','email' => 'teste@teste.com.br','phone' => ['areacode' => 12, 'number' => '5615-9252',],'documents' => [['type' => 'CPF', 'number' => '39994806881',]]]];
        $this->objectPaymentRequest->setRequest($this->dataTest);
        $this->assertArrayHasKey('sender', $this->objectPaymentRequest->data);
    }

    public function testCallRequest()
    {
        $this->assertEquals(false, $this->objectPaymentRequest->sendReques());
    }

}
