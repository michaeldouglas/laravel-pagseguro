<?php
namespace laravel\pagseguro\Complements;

trait DataRequestHydrator
{
    public function separatorDataRequest($data)
    {
        return array_merge($data->data['address'],  $data->data['items']);
    }
}