<?php

namespace laravel\pagseguro\Transaction\Information;

/**
 * Transaction Information Data Normalizer
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-05-06
 *
 * @copyright  Laravel\PagSeguro
 */
class InformationNormalizer
{

    /**
     * Normalize data Keys
     * @return array
     */
    public function transactionNormalized($data)
    {
        $newData = [];
        $map = [
            'count' => 'Count',
            'method' => 'Method',
            'eventdate' => 'EventDate',
        ];
        $mapFrom = array_keys($map);
        $mapTo = array_values($map);
        foreach ($data as $key => $value) {
            $normalized = str_replace($mapFrom, $mapTo, $key);
            $newData[$normalized] = $value;
        }
        return $newData;
    }

    /**
     * Normalize Keys
     * @return array
     */
    public function amountNormalized($data)
    {
        foreach ($data as $key => $value) {
            $newCase = str_replace('amount', 'Amount', $key);
            unset($data[$key]);
            $data[$newCase] = $value;
        }
        return $data;
    }

    /**
     * @param array $phoneInfo
     * @return array|null
     */
    public function phoneNormalized($phoneInfo)
    {
        if (!is_array($phoneInfo)) {
            return null;
        }
        $this->changeKeys('areacode', 'areaCode', $phoneInfo);
        $phone = [
            'areaCode' => $phoneInfo['areaCode'],
            'number' => $phoneInfo['number'],
        ];
        return $phone;
    }

    /**
     * @param array $documentsInfo
     * @return array|null
     */
    public function documentsNormalized($documentsInfo)
    {
        if (!is_array($documentsInfo)) {
            return null;
        }
        $allDocs = [];
        foreach ($documentsInfo as $documentInfo) {
            $this->changeKeys('value', 'number', $documentInfo);
            $allDocs[] = $documentInfo;
        }
        return $allDocs;
    }

    /**
     * Shipping Key Case normalized
     * @param array $data
     * @return array
     */
    public function shippingNormalized($data)
    {
        $this->changeKeys(
            'postalcode',
            'postalCode',
            $data['address']
        );
        return $data;
    }

    /**
     * @param string $from
     * @param string $to
     * @param array $data
     * @return void
     */
    private function changeKeys($from, $to, array &$data)
    {
        if (array_key_exists($from, $data)) {
            $value = $data[$from];
            unset($data[$from]);
            $data[$to] = $value;
        }
    }
}
