<?php

namespace App\Repository\mastercardAPI;

use App\Models\PaymentTransaction;

class MasterCardPay
{
    public $card_cvv, $card_token, $transaction_amount, $transaction_id, $error_msg;

    public function __construct($card_cvv, $card_token, $transaction_amount,  $transaction_id)
    {
        $this->setCardCvv($card_cvv);
        $this->setCardToken($card_token);
        $this->setTransactionAmount($transaction_amount);
        $this->setTransactionId($transaction_id);
    }

    /**
     * @return mixed
     */
    public function getCardCvv()
    {
        return $this->card_cvv;
    }

    /**
     * @param mixed $card_cvv
     */
    public function setCardCvv($card_cvv): void
    {
        $this->card_cvv = $card_cvv;
    }

    /**
     * @return mixed
     */
    public function getCardToken()
    {
        return $this->card_token;
    }

    /**
     * @param mixed $card_token
     */
    public function setCardToken($card_token): void
    {
        $this->card_token = $card_token;
    }

    /**
     * @return mixed
     */
    public function getTransactionAmount()
    {
        return $this->transaction_amount;
    }

    /**
     * @param mixed $transaction_amount
     */
    public function setTransactionAmount($transaction_amount): void
    {
        $this->transaction_amount = $transaction_amount;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * @param mixed $transaction_id
     */
    public function setTransactionId($transaction_id): void
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this->error_msg;
    }

    /**
     * @param mixed $error_msg
     */
    public function setErrorMsg($error_msg): void
    {
        $this->error_msg = $error_msg;
    }


    public function pay()
    {
        $masterCardApi = new MasterCardApi();
        $payResponse = $masterCardApi->transactionPay(
            [
                'card_token' => $this->getCardToken(),
                'card_cvv' => $this->getCardCvv(),
            ],
            [
                'transaction_amount' => $this->getTransactionAmount(),
                'transaction_id' => $this->getTransactionId(),
            ]
        );
        $payResponse = $payResponse->json();
        if ($payResponse['result'] === "SUCCESS" and $payResponse['response']['acquirerCode'] == 00) {
            return [
                'status' => 'true',
                'response' => $payResponse,
            ];
        }

        $this->setErrorMsg($payResponse['response']['acquirerMessage']);
        return [
            'status' => false,
            'errorMsg' => $this->getErrorMsg(),
            'response' => $payResponse,
        ];
    }


}
