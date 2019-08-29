<?php

namespace laravel\pagseguro\Plans;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Remote\Plans as RemotePlans;
use laravel\pagseguro\Checkout\Information\InformationFactory;

class Plans extends AbstractPlans implements PlansInterface
{
    /**
     * @var $preApproval
     */
    protected $preApproval;

    /**
     * @var $body
     */
    protected $body;

    public function getBody()
    {
        return $this->body;
    }

    public function getpreApproval()
    {
        return $this->preApproval;
    }

    public function setBody($body)
    {
        if (is_null($body)) {
            throw new \InvalidArgumentException('Invalid body');
        }
        $this->body = $body;
        return $this;
    }

    public function setpreApproval($preApproval)
    {
        if (is_null($preApproval)) {
            throw new \InvalidArgumentException('Invalid preApproval');
        }
        $this->preApproval = $preApproval;
        return $this;
    }

    public function send(CredentialsInterface $credentials)
    {
        $remote = new RemotePlans();
        $data = $remote->send($this, $credentials);
        $factory = new InformationFactory($data);
        return $factory->getInformation();
    }
}