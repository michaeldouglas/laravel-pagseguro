<?php

namespace laravel\pagseguro\Receiver;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

/**
 * Receiver Object
 *
 * @category   Receiver
 * @package    Laravel\PagSeguro\Receiver
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class Receiver implements ReceiverInterface
{

    /**
     * @var string
     */
    protected $email;

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
        $this->hydrateMagic(['email'], $args);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
