<?php

namespace laravel\pagseguro\Plans;

interface PlansInterface
{
    /**
     * Constructor
     * @param array $data Checkout data
     */
    public function __construct($data = []);

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return array
     */
    public function getpreApproval();

    /**
     * @param $references
     * @return array
     */
    public function setBody($references);

    /**
     * @param $preApproval
     * @return array
     */
    public function setpreApproval($preApproval);
}