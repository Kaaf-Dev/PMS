<?php

namespace App\Repository\BenefitPay;

use Illuminate\Support\Facades\Http;

class benefitPayCheckStatus
{
    private $referenceNumber;
    private $merchantId;
    private $app_id;

    private $secret_key;


    public function __construct($referenceNumber, $merchantId, $payment_gateway = 'kaaf')
    {
        $this->setReferenceNumber($referenceNumber);
        $this->setMerchantId($merchantId);

        if ($payment_gateway == 'kaaf') {
            $this->setAppId(env('BENEFIT_PAY_APP_ID_KAAF'));
            $this->setSecretKey(env('BENEFIT_PAY_SECRET_KEY_KAAF'));

        } elseif ($payment_gateway == 'eslah') {
            $this->setAppId(env('BENEFIT_PAY_APP_ID_ESLAH'));
            $this->setSecretKey(env('BENEFIT_PAY_SECRET_KEY_ESLAH'));

        }
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param mixed $merchantId
     */
    public function setMerchantId($merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param mixed $app_id
     */
    public function setAppId($app_id): void
    {
        $this->app_id = $app_id;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param mixed $referenceNumber
     */
    public function setReferenceNumber($referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * @param mixed $secret_key
     */
    public function setSecretKey($secret_key): void
    {
        $this->secret_key = $secret_key;
    }


    public function check_status()
    {
        $url = env("BENEFIT_PAY_END_POINT");


        $hash = '';
        $hash .= 'merchant_id="' . $this->getMerchantId() . '"';
        $hash .= ',reference_id="' . $this->getReferenceNumber() . '"';

        $hash = hash_hmac('sha256', $hash, $this->getSecretKey(), true);
        $hash = base64_encode($hash);

        // Send POST request with payload
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-FOO-Signature' => $hash,
            'X-CLIENT-ID' => $this->getAppId(),
        ])->post($url, [
            'merchant_id' => $this->getMerchantId(),
            'reference_id' => $this->getReferenceNumber(),
        ]);

        $payResponse = $response->json();
        if ($payResponse) {
            if ($payResponse['response']['status'] === "success") {
                return [
                    'status' => true,
                    'response' => $payResponse['response'],
                    'down' => false
                ];
            } else {
                return [
                    'status' => false,
                    'down' => false
                ];
            }
        } else {
            return [
                'status' => false,
                'down' => true,
            ];
        }


    }

}
