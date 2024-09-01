<?php

namespace App\Jobs;

use App\Events\ReceiptCreated;
use App\Models\PaymentTransaction;
use App\Models\Receipt;
use App\Repository\BenefitPay\benefitPayCheckStatus;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BenefitPayCheckStatusDown implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $referenceNumber;
    public $payment_gateway = 'kaaf';
    public $merchantId;

    public function __construct($referenceNumber, $payment_gateway)
    {
        $this->referenceNumber = $referenceNumber;
        $this->payment_gateway = $payment_gateway;

        $this->merchantId = env("BENEFIT_PAY_MERCHANT_ID_KAAF");
        if ($payment_gateway == 'eslah') {
            $this->merchantId = env("BENEFIT_PAY_MERCHANT_ID_ESLAH");
        }
    }


    public function handle()
    {
        $check_status = new benefitPayCheckStatus($this->referenceNumber, $this->merchantId, $this->payment_gateway);
        $transaction = PaymentTransaction::where('trx_id', '=', $this->referenceNumber)->first();

        if ($transaction) {
            $invoice = $transaction->Invoice; // Get invoice

            if ($invoice) {
                $result = $check_status->check_status();

                if ($result['down']) { // Check status down
                    $transaction->down();
                }

                if ($result['status']) { // Create receipt if successful payment
                    $receipt = new \App\Repository\receiptProvider($transaction->Invoice->id, $transaction->id, Receipt::PAYMENT_METHOD_BENEFIT, $result['response']['amount']);

                    if ($transaction->close()) {
                        $receipt = $receipt->createReceipt();
                        event(new ReceiptCreated($receipt));
                    }
                } else { // Failed payment
                    $transaction->failed();
                }
            }
        }
    }
}
