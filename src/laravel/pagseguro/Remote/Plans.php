<?php

namespace laravel\pagseguro\Remote;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Http\Request\RequestInterface;
use laravel\pagseguro\Plans\PlansInterface;

class Plans extends ConsumerAbstract
{
    public function send(PlansInterface $plans, CredentialsInterface $credential)
    {
        $url = $this->getUrlTo('pre-approvals');
        $request = $this->getRequest();
        $this->prepareStatement($plans, $request);
        $credentialData = $this->getCredentialData($credential);
        $response = $request->post($url, $credentialData);
        if (!$response) {
            throw new \RuntimeException('Checkout send failure');
        }
        $body = $response->getRawBody();

        if ($response->getHttpStatus() !== 200) {
            $error = 'Error on send: ' . $response->getHttpStatus() . '-' . $body;
            throw new \RuntimeException($error);
        }

        $data = json_decode($body, true);
        if (array_key_exists('code', $data)) {
            $paymentUrl = str_replace(['ws.', '/pre-approvals', '/request'], '', $url) . '/v2/pre-approvals/request.html?code=';
            $data['link'] =  $paymentUrl . $data['code'];
        }

        return $data;
    }

    protected function prepareStatement(PlansInterface $plans, RequestInterface $request)
    {

        $array = $this->change_key($plans->getpreApproval()->toArray(), 'name', 'preApprovalName');
        $array = $this->change_key($array, 'charge', 'preApprovalCharge');
        $array = $this->change_key($array, 'period', 'preApprovalPeriod');
        $array = $this->change_key($array, 'amountPerPayment', 'preApprovalAmountPerPayment');
        $array = $this->change_key($array, 'membershipFee', 'preApprovalMembershipFee');
        $array = $this->change_key($array, 'trialPeriodDuration', 'preApprovalTrialPeriodDuration');
        $array = $this->change_key($array, 'details', 'preApprovalDetails');

        $dataRequest = http_build_query(array_merge($plans->toArray()['body'], $array ));

        $charset = 'UTF-8';
        $request->setData($dataRequest)->setCharset($charset)
            ->setHeaders([
                'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
            ]);
    }

    private function change_key( $array, $old_key, $new_key ) {
        if( ! array_key_exists( $old_key, $array ) )
            return $array;

        $keys = array_keys( $array );
        $keys[ array_search( $old_key, $keys ) ] = $new_key;

        return array_combine( $keys, $array );
    }
}