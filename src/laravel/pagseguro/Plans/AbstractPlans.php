<?php


namespace laravel\pagseguro\Plans;


use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorProtectedTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Complements\ValidationRulesInterface;

class AbstractPlans
{
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
                'references', 'preApproval'
            ],
            $args
        );
    }

    /**
     * @return ValidationRulesInterface
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}