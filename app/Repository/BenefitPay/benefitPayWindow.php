<?php

namespace App\Repository\BenefitPay;

class benefitPayWindow
{
    public $transaction;
    public $secret_key;

    /**
     * @param $transaction
     */
    public function __construct($transaction, $invoice, $payment_gateway = 'kaaf')
    {
        if ($payment_gateway == 'kaaf') {
            $this->transaction['appId'] = env("BENEFIT_PAY_APP_ID_KAAF");
            $this->transaction['merchantId'] = env("BENEFIT_PAY_MERCHANT_ID_KAAF");
            $this->secret_key = env('BENEFIT_PAY_SECRET_KEY_KAAF');

        } elseif ($payment_gateway == 'eslah') {
            $this->transaction['appId'] = env("BENEFIT_PAY_APP_ID_ESLAH");
            $this->transaction['merchantId'] = env("BENEFIT_PAY_MERCHANT_ID_ESLAH");
            $this->secret_key = env('BENEFIT_PAY_SECRET_KEY_ESLAH');

        }
        $this->transaction['hideMobileQR'] = 0;
        $this->transaction['referenceNumber'] = $transaction->trx_id;
        $this->transaction['showResult'] = 1;
        $this->transaction['transactionAmount'] = number_format($invoice->amount, 3);
        $this->transaction['transactionCurrency'] = 'BHD';
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


    public function calculateHash()
    {
        $hash = '';
        $hash .= 'appId="' . $this->transaction['appId'] . '"';
        $hash .= ',merchantId="' . $this->transaction['merchantId'] . '"';
        $hash .= ',referenceNumber="' . $this->transaction['referenceNumber'] . '"';
        $hash .= ',transactionAmount="' . $this->transaction['transactionAmount'] . '"';
        $hash .= ',transactionCurrency="' . $this->transaction['transactionCurrency'] . '"';

        $hash = hash_hmac('sha256', $hash, $this->getSecretKey(), true);

        $hash = base64_encode($hash);
        $this->transaction['secure_hash'] = $hash;
    }

}
