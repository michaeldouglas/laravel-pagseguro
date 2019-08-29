<?php

namespace laravel\pagseguro\Plans\Facade;

use laravel\pagseguro\Plans\PreApproval\PreApproval;
use laravel\pagseguro\Plans\PreApproval\PreApprovalInterface;

class DataFacade
{
    public function ensureInstances(array $data)
    {
        if (array_key_exists('preApproval', $data)) {
            $data['preApproval'] = $this->ensurePreApproval($data['preApproval']);
        }
        return $data;
    }

    private function ensurePreApproval($preApproval)
    {
        if ($preApproval instanceof PreApprovalInterface) {
            return $preApproval;
        }
        if (!is_array($preApproval)) {
            throw new \InvalidArgumentException('Invalid sender data');
        }
        return new PreApproval($preApproval);
    }
}