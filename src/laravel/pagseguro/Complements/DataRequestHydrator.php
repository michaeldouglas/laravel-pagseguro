<?php

namespace laravel\pagseguro\Complements;

trait DataRequestHydrator
{

    public function separatorDataRequest($data)
    {
        return array_merge($this->setDataPagSeguro($data), $this->getItemsSeparator($data));
    }

    private function getItemsSeparator($data)
    {
        $numberItem = 0;
        foreach ($data->data['items'] as $key => $value) {
            $numberItem++;
            $dataItem["itemId$numberItem"] = (array_key_exists($key, $value) ? $value[$key] : null);
            $dataItem["itemDescription$numberItem"] = (array_key_exists("itemDescription$numberItem", $value) ? $value["itemDescription$numberItem"] : null);
            $dataItem["itemQuantity$numberItem"] = (array_key_exists("itemQuantity$numberItem", $value) ? $value["itemQuantity$numberItem"] : null);
            $dataItem["itemWeight$numberItem"] = (array_key_exists("itemWeight$numberItem", $value) ? $value["itemWeight$numberItem"] : null);
            $dataItem["itemShippingCost$numberItem"] = (array_key_exists("itemShippingCost$numberItem", $value) ? $value["itemShippingCost$numberItem"] : null);
            $dataItem["itemAmount$numberItem"] = (array_key_exists("itemAmount$numberItem", $value) ? $value["itemAmount$numberItem"] : null);
        }
        return $dataItem;
    }

    protected function setDataPagSeguro($data)
    {
        $this->extractSenderName($data->data)->extractSenderCPF($data->data)
        ->extractSenderEmail($data->data)->extractSenderAreacode($data->data)
        ->extractSenderPhone($data->data, $data->sender);
        $this->clearArrObjectRequest($data->data, ['sender', 'address']);
        return array_filter($data->data);
    }

    private function extractPostalCode(&$data)
    {
        $keys = array_fill_keys(['postalCode'], null);
        $keySender = array_intersect_key($data['address'], $keys);
        $data['postalCode'] = (array_key_exists('postalCode', $keySender) ? $keySender['postalCode'] : null);
        return $this;
    }

    private function extractSenderName(&$data)
    {
        $keys = array_fill_keys(['name'], null);
        $keySender = array_intersect_key($data['sender'], $keys);
        $data['senderName'] = (array_key_exists('name', $keySender) ? $keySender['name'] : null);
        return $this;
    }
    
    private function extractSenderCPF(&$data)
    {
        $keys = array_fill_keys(['senderCPF'], null);
        $keySender = array_intersect_key($data['sender'], $keys);
        $data['senderCPF'] = (array_key_exists('senderCPF', $keySender) ? $keySender['senderCPF'] : null);
        return $this;
    }
    
    private function extractSenderEmail(&$data)
    {
        $keys = array_fill_keys(['senderEmail'], null);
        $keySender = array_intersect_key($data['sender'], $keys);
        $data['senderEmail'] = (array_key_exists('senderEmail', $keySender) ? $keySender['senderEmail'] : null);
        return $this;
    }
    
    private function extractSenderAreacode(&$data)
    {
        $keys = array_fill_keys(['senderAreacode'], null);
        $keySender = array_intersect_key($data['sender']['phone'], $keys);
        $data['senderAreacode'] = (array_key_exists('senderAreacode', $keySender) ? $keySender['senderAreacode'] : null);
        return $this;
    }
    
    private function extractSenderPhone(&$data, $sender)
    {
        $keys = array_fill_keys(['senderPhone'], null);
        $keySender = array_intersect_key($data['sender']['phone'], $keys);
        $data['senderPhone'] = (array_key_exists('senderPhone', $keySender) ? $sender->getPhone()->getSenderPhone() : null);
        return $this;
    }

    private function clearArrObjectRequest(&$data, $arrClear)
    {
        foreach ($arrClear as $value) {
            unset($data[$value]);
        }
    }

}
