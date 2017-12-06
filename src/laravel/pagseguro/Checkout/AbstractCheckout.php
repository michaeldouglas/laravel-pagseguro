<?php

namespace laravel\pagseguro\Checkout;

use laravel\pagseguro\Checkout\Metadata\MetadataCollection;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Abstract Checkout Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
abstract class AbstractCheckout
{

    /**
     * @var string
     */
    protected $charset = 'UTF-8';

    /**
     * Addition or Discount
     * @var float
     */
    protected $extraAmount;

    /**
     * @var int
     */
    protected $maxAge;

    /**
     * @var int
     */
    protected $maxUses;

    /**
     * @var MetadataCollection
     */
    protected $metadata;

    /**
     * @var string
     */
    protected $notificationURL;

    /**
     * @var string
     */
    protected $redirectURL;

    /**
     * @var string
     */
    protected $reference;

    use DataHydratorTrait, DataHydratorProtectedTrait, DataHydratorConstructorTrait, ValidateTrait {
        DataHydratorProtectedTrait::hydrate insteadof DataHydratorTrait;
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array|string $data Notification Required Data or String Code
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        $data = null;
        $this->hydrateMagic(
            [
                'items', 'sender', 'shipping', 'currency',
                'metadata', 'redirectURL', 'notificationURL',
                'charset'
            ],
            $args
        );
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param string $charset
     * @return CheckoutInterface
     */
    public function setCharset($charset)
    {
        $upper = strtoupper($charset);
        if (!in_array($upper, ['UTF-8', 'ISO-8859-1'])) {
            throw new \InvalidArgumentException('Invalid charset');
        }
        $this->charset = $upper;
        return $this;
    }

    /**
     * @return float
     */
    public function getExtraAmount()
    {
        return $this->extraAmount;
    }

    /**
     * Set Addition or Discount
     * @param float $extraAmount
     * @return CheckoutInterface
     */
    public function setExtraAmount($extraAmount)
    {
        $this->extraAmount = $extraAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * @param int $maxAge
     * @return CheckoutInterface
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = $maxAge;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxUses()
    {
        return $this->maxUses;
    }

    /**
     * @param int $maxUses
     * @return CheckoutInterface
     */
    public function setMaxUses($maxUses)
    {
        $this->maxUses = $maxUses;
        return $this;
    }

    /**
     * @return MetadataCollection
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param MetadataCollection $metadata
     * @return CheckoutInterface
     */
    protected function setMetadata($metadata)
    {
        if ($metadata && !($metadata instanceof MetadataCollection)) {
            $this->metadata = $metadata;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getNotificationURL()
    {
        return $this->notificationURL;
    }

    /**
     * @param string $notificationURL
     * @return CheckoutInterface
     */
    public function setNotificationURL($notificationURL)
    {
        $this->notificationURL = $notificationURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectURL()
    {
        return $this->redirectURL;
    }

    /**
     * @param string $redirectURL
     * @return CheckoutInterface
     */
    public function setRedirectURL($redirectURL)
    {
        $this->redirectURL = $redirectURL;
        return $this;
    }


    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return CheckoutInterface
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}
