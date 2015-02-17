<?php

use laravel\pagseguro\Request\PaymentRequest,
    laravel\pagseguro\Credentials\Credentials;

/**
 * PaymentRequest Test
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
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

        $this->dataTest = [
            'items' => [
                'item1' => ['id' => '0001','description' => 'Notebook Prata 1','quantity' => '1','amount' => '10.00','weight' => '1000','shippingCost' => null],
                'item2' => ['id' => '0002','description' => 'Notebook Prata 2','quantity' => '2','amount' => '5.00','weight' => '100','shippingCost' => null]
            ],
            'address' => ['postalCode' => '04433130','street' => 'Rua benjamin vieira da silva','number' => '1077','complement' => '','district' => 'Centro','city' => 'São Paulo','state' => 'SP','country' => 'BRA',],
            'sender' => [
                'name' => 'Teste do comprador',
                'email' => 'michael.araujo@idealinvest.com.br',
                'phone' => ['areaCode' => 11,'number' => '5614-9351',],
                'documents' => [['type' => 'CPF','number' => '31985741539',]],
            ]
        ];
        
        $this->objectPaymentRequest->setRequest($this->dataTest);
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
        $this->assertArrayHasKey('items', $this->objectPaymentRequest->data);
    }
    
    public function testDataAddress()
    {
        $this->assertArrayHasKey('address', $this->objectPaymentRequest->data);
    }
    
    public function testDataSender()
    {
        $this->assertArrayHasKey('sender', $this->objectPaymentRequest->data);
    }
    
    public function testCallRequest()
    {
        $this->assertEquals(false, $this->objectPaymentRequest->sendReques());
    }

}
