<?php

namespace laravel\pagseguro\Checkout\Statement\Xml;

use laravel\pagseguro\Document\DocumentInterface;
use laravel\pagseguro\Sender\SenderInterface;

/**
 * Checkout Statement Xml Sender
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class XmlSender implements XmlPartInterface
{
    /**
     * @var SenderInterface
     */
    protected $sender;

    /**
     * Constructor
     * @param SenderInterface $sender
     */
    public function __construct(SenderInterface $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return string
     */
    public function getXmlString()
    {
        return
            '<sender>' .
            $this->getEmailXmlString() .
            $this->getNameXmlString() .
            $this->getPhoneXmlString() .
            $this->getDocumentsXmlString() .
            $this->getBornDateXmlString() .
            '</sender>';
    }

    /**
     * @return string XML
     */
    private function getNameXmlString()
    {
        $str = '<name>%s</name>';
        return sprintf($str, $this->sender->getName());
    }

    /**
     * @return string XML
     */
    private function getEmailXmlString()
    {
        $str = '<email>%s</email>';
        return sprintf($str, $this->sender->getEmail());
    }

    /**
     * @return string XML
     */
    private function getBornDateXmlString()
    {
        $date = $this->sender->getBornDate();
        if (!$date) {
            return null;
        }
        $dateObj = \DateTime::createFromFormat('Y-m-d', $date);
        $str = '<bornDate>%s</bornDate>';
        return sprintf($str, $dateObj->format('d/m/Y'));
    }

    /**
     * @return string XML
     */
    private function getPhoneXmlString()
    {
        $phone = $this->sender->getPhone();
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
        $docs = $this->sender->getDocuments();
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
}
