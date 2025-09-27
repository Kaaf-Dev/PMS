<?php

namespace App\Repository\EazyPay;


use App\Models\PaymentTransaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class EazyPayCore
{


    private $secret_key;
    private $app_id;
    private $merchant_id;

    private $amount;
    private $transaction;
    private $currency = 'BHD';
    private $endpoint;
    private $invoice_id;
    private $payment_methods;

    private $webhook_url;

    public function __construct(PaymentTransaction $transaction, $payment_methods, $amount, $payment_gateway)
    {
        if ($payment_gateway === 'eslah') {
            $this->setAppId(env('ESLAH_EAZY_PAY_APP_ID'));
            $this->setMerchantId(env('ESLAH_EAZY_PAY_MERCHANT_ID'));
            $this->setSecretKey(env('ESLAH_EAZY_PAY_SECRET_KEY'));
        }

        if ($payment_gateway === 'kaaf') {
            $this->setAppId(env('KAAF_EAZY_PAY_APP_ID'));
            $this->setMerchantId(env('KAAF_EAZY_PAY_MERCHANT_ID'));
            $this->setSecretKey(env('KAAF_EAZY_PAY_SECRET_KEY'));
        }

        $this->setAmount($amount);
        $this->setInvoiceId($transaction->trx_id);
        $this->setPaymentMethods($payment_methods);
        $this->setEndpoint(env('EAZY_PAY_ENDPOINT'));
        $this->setTransaction($transaction);
        $this->setWebhookUrl(env('EAZY_PAY_WEBHOOK_URL'));
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
    public function getMerchantId()
    {
        return $this->merchant_id;
    }

    /**
     * @param mixed $merchant_id
     */
    public function setMerchantId($merchant_id): void
    {
        $this->merchant_id = $merchant_id;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return number_format($this->amount, 3);
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param mixed $transaction
     */
    public function setTransaction($transaction): void
    {
        $this->transaction = $transaction;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @param mixed $invoice_id
     */
    public function setInvoiceId($invoice_id): void
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethods()
    {
        return $this->payment_methods;
    }

    /**
     * @param mixed $payment_methods
     */
    public function setPaymentMethods($payment_methods): void
    {
        $this->payment_methods = $payment_methods;
    }

    /**
     * @return mixed
     */
    public function getWebhookUrl()
    {
        return $this->webhook_url;
    }

    /**
     * @param mixed $webhook_url
     */
    public function setWebhookUrl($webhook_url): void
    {
        $this->webhook_url = $webhook_url;
    }


    public function generatePaymentUrl()
    {

        $timestamp = (string)floor(microtime(true) * 1000);
        $transaction = $this->getTransaction();
        $msg = [
            $timestamp,
            $this->currency,
            $this->getAmount(),
            $this->getAppId()
        ];

        $msg = implode('', $msg);
        $secret_hash = hash_hmac('sha256', $msg, $this->getSecretKey());
        $content_type = 'application/json; charset=utf-8';
        $headers = [
            'Secret-Hash' => $secret_hash,
            'Timestamp' => $timestamp,
            'Content-Type' => $content_type
        ];

        $payload = [
            'appId' => $this->getAppId(),
            'invoiceId' => $this->getInvoiceId(),
            'currency' => $this->currency,
            'amount' => $this->getAmount(),
            'paymentMethod' => implode(',', $this->getPaymentMethods()),
            'firstName' => $transaction->Invoice?->Contract?->User?->name ?? 'aqar',
            'lastName' => $transaction->Invoice?->Contract?->User?->name ?? 'aqar',
            'customerEmail' => $transaction->Invoice?->Contract?->User?->email ?? 'aqar@sys.bh',
            'customerCountryCode' => '973',
            'customerMobile' => $transaction->Invoice?->Contract?->User?->phone ?? '9999999',
            'webhookUrl' => $this->getWebhookUrl(),
            'returnUrl' => env('EAZY_PAY_RETURN_URL'),
        ];


        $response = Http::withHeaders($headers)
            ->post(
                url: $this->getEndpoint() . '/createInvoice',
                data: $payload,
            );

        $response_json = $response->json();

        if ($response->ok()) {

            $code_result = Arr::get($response_json, 'result.code');

            if ($code_result == '1') {
                $global_transaction_id = Arr::get($response_json, 'data.0.globalTransactionsId');
                $payment_url = Arr::get($response_json, 'data.0.paymentUrl');

                $transaction->global_transaction_id = $global_transaction_id;
                $transaction->payment_url = $payment_url;
                $transaction->save();

                return [
                    'status' => true,
                    'transaction' => $transaction
                ];

            } else {
                return [
                    'status' => false,
                    'error' => Arr::get($response_json, 'result.description'),
                ];
            }
        } else {
            return [
                'status' => false,
                'error' => 'لا يمكن إتمام العملية'
            ];
        }

    }
}
