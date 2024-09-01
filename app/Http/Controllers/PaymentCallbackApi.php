<?php

namespace App\Http\Controllers;

use App\Events\ReceiptCreated;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\Receipt;
use App\Repository\BenefitPay\benefitPayCheckStatus;
use App\Repository\receiptProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentCallbackApi extends Controller
{
    public function benefitKaafResponse()
    {
        $request = request();
        // Check if x-foo-signature header exists
        if ($request->hasHeader('x-foo-signature')) {
            info(1);

            $foo_signature = $request->header("x-foo-signature");
            $referenceNumber = $request->input('reference_number');
            $merchantId = $request->input('merchant_id');
            $amount = $request->input('amount');
            $status = $request->input('status');
            $app_id = $request->input('app_id');
            $secret_token = env("BENEFIT_PAY_SECRET_CALLBACK_KEY_KAAF");
            $encodedJson = json_encode($request->all());

            // Check if all required parameters are present
            if (isset($status) && $merchantId && $referenceNumber && $app_id) {
                info(2);

                $hmac = hash_hmac("sha256", $encodedJson, $secret_token, true);
                // Compare signatures
                if (hash_equals($foo_signature, base64_encode($hmac))) {
                    info(3);

                    // Check if merchantId and app_id match with configured values
                    if (($merchantId === env("BENEFIT_PAY_MERCHANT_ID_KAAF")) && ($app_id === env("BENEFIT_PAY_APP_ID_KAAF")) && $status <= 1) {
                        $check_status = new benefitPayCheckStatus($referenceNumber, $merchantId, 'kaaf');
                        $transaction = PaymentTransaction::where('trx_id', '=', $referenceNumber)->first();

                        if ($transaction) {
                            $invoice = $transaction->Invoice; // Get invoice

                            if ($invoice) {
                                $result = $check_status->check_status();

                                if ($result['down']) { // Check status down
                                    $transaction->down();
                                }

                                if ($result['status']) { // Create receipt if successful payment
                                    if ($transaction->close()) {
                                        $receipt = new receiptProvider($transaction->Invoice->id, $transaction->id, Receipt::PAYMENT_METHOD_BENEFIT, $result['response']['amount']);
                                        if ($transaction->close()) {
                                            $receipt = $receipt->createReceipt();
                                            event(new ReceiptCreated($receipt));
                                        }
                                    }
                                } else { // Failed payment
                                    $transaction->failed();
                                }

                                // Success response
                                return [
                                    "response" => [
                                        "statusCode" => 200,
                                        "message" => 'Success'
                                    ],
                                ];
                            }
                        }
                    }

                    // Incorrect merchantId or app_id
                    return [
                        "response" => [
                            "statusCode" => 300,
                            "message" => 'Failure'
                        ],
                    ];


                } else {
                    // Signatures don't match
                    return [
                        "response" => [
                            "statusCode" => 401,
                            "message" => 'Authentication failure'
                        ],
                    ];
                }
            } else {
                // Bad Request - missing parameters
                return [
                    "response" => [
                        "statusCode" => 400,
                        "message" => 'Bad Request'
                    ],
                ];
            }
        } else {
            // x-foo-signature header is missing
            return [
                "response" => [
                    "statusCode" => 401,
                    "message" => 'Authentication failure'
                ],
            ];
        }
    }

    public function benefitEslahResponse()
    {
        $request = request();

        // Check if x-foo-signature header exists
        if ($request->hasHeader('x-foo-signature')) {
            $foo_signature = $request->header("x-foo-signature");
            $referenceNumber = $request->input('reference_number');
            $merchantId = $request->input('merchant_id');
            $amount = $request->input('amount');
            $status = $request->input('status');
            $app_id = $request->input('app_id');
            $secret_token = env("BENEFIT_PAY_SECRET_CALLBACK_KEY_ESLAH");
            $encodedJson = json_encode($request->all());

            // Check if all required parameters are present
            if (isset($status) && $merchantId && $referenceNumber && $app_id) {
                $hmac = hash_hmac("sha256", $encodedJson, $secret_token, true);
                // Compare signatures
                if (hash_equals($foo_signature, base64_encode($hmac))) {
                    // Check if merchantId and app_id match with configured values
                    if (($merchantId === env("BENEFIT_PAY_MERCHANT_ID_ESLAH")) && ($app_id === env("BENEFIT_PAY_APP_ID_ESLAH")) && $status <= 1) {
                        $check_status = new benefitPayCheckStatus($referenceNumber, $merchantId, 'eslah');
                        $transaction = PaymentTransaction::where('trx_id', '=', $referenceNumber)->first();

                        if ($transaction) {
                            $invoice = $transaction->Invoice; // Get invoice

                            if ($invoice) {
                                $result = $check_status->check_status();

                                if ($result['down']) { // Check status down
                                    $transaction->down();
                                }

                                if ($result['status']) { // Create receipt if successful payment
                                    if ($transaction->close()) {
                                        $receipt = new receiptProvider($transaction->Invoice->id, $transaction->id, Receipt::PAYMENT_METHOD_BENEFIT, $result['response']['amount']);
                                        if ($transaction->close()) {
                                            $receipt = $receipt->createReceipt();
                                            event(new ReceiptCreated($receipt));
                                        }
                                    }
                                } else { // Failed payment
                                    $transaction->failed();
                                }

                                // Success response
                                return [
                                    "response" => [
                                        "statusCode" => 200,
                                        "message" => 'Success'
                                    ],
                                ];
                            }
                        }
                    }

                    // Incorrect merchantId or app_id
                    return [
                        "response" => [
                            "statusCode" => 300,
                            "message" => 'Failure'
                        ],
                    ];


                } else {
                    // Signatures don't match
                    return [
                        "response" => [
                            "statusCode" => 401,
                            "message" => 'Authentication failure'
                        ],
                    ];
                }
            } else {
                // Bad Request - missing parameters
                return [
                    "response" => [
                        "statusCode" => 400,
                        "message" => 'Bad Request'
                    ],
                ];
            }
        } else {
            // x-foo-signature header is missing
            return [
                "response" => [
                    "statusCode" => 401,
                    "message" => 'Authentication failure'
                ],
            ];
        }
    }
}
