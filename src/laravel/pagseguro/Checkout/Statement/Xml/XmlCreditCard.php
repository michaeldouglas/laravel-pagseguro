<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

use laravel\pagseguro\Address\AddressInterface;
use laravel\pagseguro\Document\DocumentInterface;
use laravel\pagseguro\CreditCard\CreditCardInterface;

/**
 * Checkout Statement Xml CreditCard
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class XmlCreditCard implements XmlPartInterface
{
    /**
     * @var CreditCardInterface
     */
    protected $creditCard;

    /**
     * Constructor
     * @param CreditCardInterface $creditCard
     */
    public function __construct(CreditCardInterface $creditCard)
    {
        $this->creditCard = $creditCard;
    }

    /**
     * @return string
     */
    public function getXmlString()
    {
        //Todo: Added token to transparent checkout
        return
            '<creditCard>' .
            $this->getTokenXmlString() .
            $this->getInstallmentXmlString() .
            $this->getHolderXmlString() .
            $this->getBillingAddressXmlString($this->creditCard->getBillingAddress()) .
            '</creditCard>';
    }

    private function getHolderXmlString()
    {
        return '<holder>' .
            $this->getNameXmlString() .
            $this->getPhoneXmlString() .
            $this->getDocumentsXmlString() .
            $this->getBirthDateXmlString() .
            '</holder>';
    }
    /**
     * @return string XML
     */
    private function getTokenXmlString()
    {
        $str = '<token>%s</token>';
        return sprintf($str, $this->creditCard->getToken());
    }

    private function getInstallmentXmlString()
    {
        //Todo: Implment Installment
        //$installment = $this->creditCard->getInstallment();
        /*$str = '<installment>%s</installment>';
        return sprintf($str, $installment->ge);*/

        return '<installment>' .
            '<quantity>4</quantity>' .
            '<value>112.5</value>' .
        '</installment>';
    }
    
    /**
     * @return string XML
     */
    private function getNameXmlString()
    {
        $str = '<name>%s</name>';
        return sprintf($str, $this->creditCard->getName());
    }

    /**
     * @return string XML
     */
    private function getBirthDateXmlString()
    {
        $date = $this->creditCard->getBirthDate();
        if (!$date) {
            return null;
        }
        $dateObj = \DateTime::createFromFormat('Y-m-d', $date);
        $str = '<birthDate>%s</birthDate>';
        return sprintf($str, $dateObj->format('d/m/Y'));
    }

    /**
     * @return string XML
     */
    private function getPhoneXmlString()
    {
        $phone = $this->creditCard->getPhone();
        if (!$phone) {
            return null;
        }
        $str = <<<XML
        <phone>
            <areaCode>%s</areaCode>
            <number>%s</number>
        </phone>
XML;
        return sprintf($str, $phone->getAreaCode(), $phone->getNumber());
    }

    /**
     * @return string
     */
    public function getDocumentsXmlString()
    {
        $str = '<documents>%s</documents>';
        $documentsStr = [];
        $docs = $this->creditCard->getDocuments();
        if (!$docs || !$docs->count()) {
            return null;
        }
        $iterator = $docs->getIterator();
        while ($iterator->valid()) {
            $document = $iterator->current();
            $documentsStr[] = $this->getDocumentXmlString($document);
            $iterator->next();
        }
        return sprintf($str, implode('', $documentsStr));
    }

    /**
     * @param DocumentInterface $document
     * @return string XML
     */
    private function getDocumentXmlString(DocumentInterface $document)
    {
        $str = <<<XML
        <document>
            <type>%s</type>
            <value>%s</value>
        </document>
XML;
        return sprintf($str, $document->getType(), $document->getNumber());
    }

    /**
     * @param AddressInterface $billingAddress
     * @return string XML
     */
    private function getBillingAddressXmlString(AddressInterface $billingAddress)
    {
        $str = <<<XML
        <billingAddress>
            <street>%s</street>
            <number>%s</number>
            <complement>%s</complement>
            <district>%s</district>
            <postalCode>%s</postalCode>
            <city>%s</city>
            <state>%s</state>
            <country>%s</country>
        </billingAddress>
XML;
        return sprintf(
            $str,
            $billingAddress->getStreet(),
            $billingAddress->getNumber(),
            $billingAddress->getComplement(),
            $billingAddress->getDistrict(),
            $billingAddress->getPostalCode(),
            $billingAddress->getCity(),
            $billingAddress->getState(),
            $billingAddress->getCountry()
        );
    }
}
