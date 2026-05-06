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
            'PMS_0001750' => 150,
            'PMS_0001754' => 250,
            'PMS_0001759' => 250,
            'PMS_0001767' => 170,
            'PMS_0001771' => 200,
            'PMS_0001772' => 250,
            'PMS_0001787' => 220,
            'PMS_0001788' => 220,
            'PMS_0001791' => 250,
            'PMS_0001802' => 300,
            'PMS_0001806' => 260,
            'PMS_0001820' => 160,
            'PMS_0001822' => 150,
            'PMS_0001823' => 150,
            'PMS_0001824' => 160,
            'PMS_0001825' => 350,
            'PMS_0001829' => 150,
            'PMS_0001832' => 250,
            'PMS_0001833' => 200,
            'PMS_0001834' => 200,
            'PMS_0001845' => 150,
            'PMS_0001846' => 280,
            'PMS_0001852' => 170,
            'PMS_0001856' => 250,
            'PMS_0001857' => 250,
            'PMS_0001872' => 250,
            'PMS_0001886' => 190,
            'PMS_0001894' => 250,
            'PMS_0001898' => 160,
            'PMS_0001899' => 250,
            'PMS_0001902' => 250,
            'PMS_0001909' => 250,
            'PMS_0001911' => 250,
            'PMS_0001913' => 250,
            'PMS_0001919' => 150,
            'PMS_0001922' => 160,
            'PMS_0001933' => 260,
            'PMS_0001938' => 150,
            'PMS_0001939' => 150,
            'PMS_0001942' => 250,
            'PMS_0001946' => 160,
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
