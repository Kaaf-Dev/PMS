<?php

namespace App\Console\Commands;

use App\Models\Receipt;
use Illuminate\Console\Command;
use App\Models\PaymentTransaction;
use App\Events\ReceiptCreated;

class CreateMissingReceipts extends Command
{
    protected $signature = 'receipts:create-missing';
    protected $description = 'Create receipts for closed transactions that have no receipt';

    public function handle()
    {
        $transactions = [
            'PMS_0001972' => 260,
            'PMS_0001974' => 280,
            'PMS_0001991' => 150,
            'PMS_0001996' => 300,
            'PMS_0001997' => 250,
            'PMS_0001999' => 150,
            'PMS_0002007' => 190,
            'PMS_0002008' => 250,
            'PMS_0002009' => 200,
            'PMS_0002013' => 250,
            'PMS_0002019' => 250,
            'PMS_0002050' => 260,
            'PMS_0002051' => 160,
            'PMS_0002053' => 250,
            'PMS_0002054' => 350,
        ];

        $payment_method = Receipt::PAYMENT_METHOD_BENEFIT;

        foreach ($transactions as $trx_id => $amount) {
            $transaction = PaymentTransaction::where('trx_id', $trx_id)->first();

            if (!$transaction) {
                $this->warn("Not found: $trx_id");
                continue;
            }

            if ($transaction->close()) {
                if (!$transaction->receipt) {
                    $receipt = new \App\Repository\receiptProvider($transaction->Invoice->id, $transaction->id, $payment_method, $amount);
                    $receipt = $receipt->createReceipt();
                    if ($receipt['status']) {
                        event(new ReceiptCreated($receipt['receipt']));
                        $this->info("Receipt created: $trx_id");
                    } else {
                        $this->error("Failed to create receipt: $trx_id");
                    }
                } else {
                    $this->line("Already has receipt: $trx_id");
                }
            } else {
                $this->error("Close failed: $trx_id");
            }
        }

        $this->info('Done.');
    }
}
