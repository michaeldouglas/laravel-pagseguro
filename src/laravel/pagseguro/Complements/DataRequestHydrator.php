<?php

namespace laravel\pagseguro\Complements;

trait DataRequestHydrator
{

    public function separatorDataRequest($data)
    {
        return array_merge($data->data, $this->getItemsSeparator($data));
    }
    
    private function getItemsSeparator($data)
    {
        $i = 0;
        foreach ($data->data['items'] as $key => $value) {
            $i++;
            $dataItem["itemId$i"] = (array_key_exists($key, $value) ? $value[$key] : null);
            $dataItem["itemDescription$i"] = (array_key_exists("itemDescription$i", $value) ? $value["itemDescription$i"] : null);
            $dataItem["itemQuantity$i"] = (array_key_exists("itemQuantity$i", $value) ? $value["itemQuantity$i"] : null);
            $dataItem["itemWeight$i"] = (array_key_exists("itemWeight$i", $value) ? $value["itemWeight$i"] : null);
            $dataItem["itemShippingCost$i"] = (array_key_exists("itemShippingCost$i", $value) ? $value["itemShippingCost$i"] : null);
            $dataItem["itemAmount$i"] = (array_key_exists("itemAmount$i", $value) ? $value["itemAmount$i"] : null);
        }
        return $dataItem;
    }
    
}
