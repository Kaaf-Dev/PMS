<?php

namespace App\Repository;

use App\Events\ReceiptCreated;
use App\Models\Invoice;
use App\Models\PaymentTransaction;
use App\Models\Receipt;
use App\Models\UserToken;
use App\Repository\mastercardAPI\MasterCardPay;
use Carbon\Carbon;

class paymentGateway
{

    protected $payment_gateway;

    /**
     * @param $payment_gateway
     */
    public function __construct($payment_gateway = 'eslah')
    {
        $this->payment_gateway = $payment_gateway;
    }


    /**
     * @return mixed
     */
    public function getPaymentGateway()
    {
        return $this->payment_gateway;
    }

    /**
     * @param mixed $payment_gateway
     */
    public function setPaymentGateway($payment_gateway): void
    {
        $this->payment_gateway = $payment_gateway;
    }



    public function PayByMasterCardDirectPay($card_token, $invoice_id)
    {
        $payment_gateway = $this->getPaymentGateway();

        $userToken = UserToken::findOrFail($card_token->id);
        $invoice = Invoice::findOrFail($invoice_id);
        $transaction_amount = $invoice->unPaidAmount;

        //createTransaction
        $transaction = $this->initiateTransaction('directPay', $invoice_id, $userToken->user_id);
        $masterCardPay = new MasterCardPay($userToken->cvv, $userToken->token, $transaction_amount, $transaction->trx_id, $payment_gateway);
        $masterCardPayResult = $masterCardPay->pay();

        //createTransaction
        $this->initiateTransactionRequest($transaction, $masterCardPayResult['response']);

        //isPayCorrect
        if ($masterCardPayResult['status']) {
            //addReceipt
            $receipt = new Receipt();
            $receipt->invoice_id = $invoice_id;
            $receipt->amount = $masterCardPayResult['response']['order']['amount'];
            $receipt->date = Carbon::now();
            $receipt->transaction_id = $transaction->id;
            $receipt->payment_method = Receipt::PAYMENT_METHOD_VISA;
            $receipt->save();

            event(new ReceiptCreated($receipt));
            $result = [
                'status' => true,
                'msg' => 'تمت العملية بنجاح',
            ];
        } else {
            $result = [
                'status' => false,
                'errors' => $masterCardPayResult['errorMsg'],
            ];
        }
        return $result;

    }

    public function initiateTransaction($gateway_name, $invoice_id, $user_id = null)
    {
        //createTransaction
        $transaction = new PaymentTransaction();
        $transaction->payment_gateway = $gateway_name;
        $transaction->invoice_id = $invoice_id;
        $transaction->save();

        return $transaction;
    }

    public function initiateTransactionRequest(PaymentTransaction $payment_transaction, $payload)
    {
        if ($payment_transaction->payment_gateway == 'directPay') {
            $payment_transaction->transactions()->create([
                'gatewayEntryPoint' => $payload['gatewayEntryPoint'],
                'amount' => $payload['order']['amount'],
                'authenticationStatus' => $payload['order']['authenticationStatus'],
                'currency' => $payload['order']['currency'],
                'merchantAmount' => $payload['order']['merchantAmount'],
                'merchantCategoryCode' => $payload['order']['merchantCategoryCode'],
                'FAILURE' => $payload['result'],
                'response_decoded' => encrypt($payload),
            ]);
        }

    }
}
