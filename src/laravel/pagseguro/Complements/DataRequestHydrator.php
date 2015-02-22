<?php
namespace laravel\pagseguro\Complements;

trait DataRequestHydrator
{
    public function separatorDataRequest($data)
    {
        $items = $data['items'];
        unset($data['items']);
        return array_merge($items, $data);
    }
}