<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Enums\PaymentMethods;
use App\Events\ReceiptCreated;
use App\Models\PaymentTransaction;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function eazyPayCallback(Request $request)
    {
        $log = [
            'headers' => $request->headers,
            'body' => $request->all(),
        ];
        info($log);

        info('========== EAZY WEBHOOK ==========');

        $rules = [
            "globalTransactionsId" => 'required',
            "transactionsId" => 'required',
            "invoiceId" => 'required',
            "currency" => 'required',
            "amount" => 'required',
            "isPaid" => 'required',
            "paidOn" => 'nullable',
            "paymentMethod" => 'nullable',
            "userToken" => 'nullable',
            "status" => 'nullable',
            "authCode" => 'nullable',
            "gatewayCode" => 'nullable',
            "authRespCode" => 'nullable',
            "errorMessage" => 'nullable',
            "errorCode" => 'nullable',
            "paymentId" => 'nullable',
            "dccUptake" => 'nullable',
            "dccCcy" => 'nullable',
            "dccAmount" => 'nullable',
            "dccReceiptText" => 'nullable'

        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $validated_data = $validator->validated();

        $global_transaction_id = Arr::get($validated_data, 'globalTransactionsId');
        $transaction_id = Arr::get($validated_data, 'transactionsId');
        $invoice_id = Arr::get($validated_data, 'invoiceId');
        $currency = Arr::get($validated_data, 'currency');
        $amount = Arr::get($validated_data, 'amount');
        $is_paid = Arr::get($validated_data, 'isPaid');
        $paid_on = Arr::get($validated_data, 'paidOn');
        $eazy_payment_method = Arr::get($validated_data, 'paymentMethod');
        $user_token = Arr::get($validated_data, 'userToken');
        $status = Arr::get($validated_data, 'status');
        $auth_code = Arr::get($validated_data, 'authCode');
        $gateway_code = Arr::get($validated_data, 'gatewayCode');
        $auth_resp_code = Arr::get($validated_data, 'authRespCode');
        $error_message = Arr::get($validated_data, 'errorMessage');
        $error_code = Arr::get($validated_data, 'errorCode');
        $payment_id = Arr::get($validated_data, 'paymentId');
        $dcc_uptake = Arr::get($validated_data, 'dccUptake');
        $dcc_ccy = Arr::get($validated_data, 'dccCcy');
        $dcc_amount = Arr::get($validated_data, 'dccAmount');
        $dcc_receipt_text = Arr::get($validated_data, 'dccReceiptText');


        try {


            if ($global_transaction_id) {

                $transaction = PaymentTransaction::where('global_transaction_id', $global_transaction_id)->first();
                if ($transaction) {
                    $secret_key = env('KAAF_EAZY_PAY_SECRET_KEY');
                    if ($transaction->Invoice->payment_gateway === 'eslah') {
                        $secret_key = env('ESLAH_EAZY_PAY_SECRET_KEY');
                    }
                    // start Eazy

                    $eazy_timestamp = $request->header('Eazy-Timestamp');
                    $eazy_signature = $request->header('Eazy-Signature');
                    $eazy_nonce = $request->header('Eazy-Nonce');


                    if ($eazy_timestamp
                        && $eazy_signature
                        && $eazy_nonce
                    ) {
                        $msg = $eazy_timestamp
                            . $eazy_nonce
                            . $global_transaction_id
                            . $is_paid;

                        if (Str::lower($eazy_signature) == Str::lower(hash_hmac(
                                algo: 'sha256',
                                data: $msg,
                                key: $secret_key))
                        ) {


                            if ($is_paid == 1) {

                                $payment_method = PaymentTransaction::MASTERCARD;
                                if ($eazy_payment_method == 'Apple Pay') {
                                    $payment_method = PaymentTransaction::APPLE;
                                }

                                if ($transaction->close()) {
                                    $receipt = new Receipt();
                                    $receipt->invoice_id = $transaction->invoice_id;
                                    $receipt->amount = $amount;
                                    $receipt->date = Carbon::now();
                                    $receipt->transaction_id = $transaction->id;
                                    $receipt->payment_method = $payment_method;
                                    $receipt->save();

                                    event(new ReceiptCreated($receipt));
                                }

                            } else {
                                $transaction->failed();
                            }
                        } else {
                            $transaction->failed();

                        }
                    } else {
                        $transaction->failed();

                    }
                } else {
                    $transaction->failed();

                }
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            return $e->getMessage();
        }
    }

}
