<?php

namespace App\Console\Commands;

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
            'PMS_0001989' => 250,
            'PMS_0001990' => 200,
            'PMS_0002002' => 200,
            'PMS_0002003' => 270,
            'PMS_0002004' => 350,
            'PMS_0002012' => 170,
            'PMS_0002020' => 250,
            'PMS_0002021' => 170,
            'PMS_0002024' => 150,
            'PMS_0002028' => 200,
            'PMS_0002029' => 200,
            'PMS_0002038' => 240,
            'PMS_0002039' => 300,
            'PMS_0002042' => 250,
            'PMS_0002043' => 300,
            'PMS_0002046' => 250,
            'PMS_0002047' => 250,
            'PMS_0002048' => 150,
            'PMS_0002052' => 200,
        ];

        foreach ($transactions as $trx_id => $amount) {
            $transaction = PaymentTransaction::where('trx_id', $trx_id)->first();

            if (!$transaction) {
                $this->warn("Not found: $trx_id");
                continue;
            }

            if ($transaction->close()) {
                if (!$transaction->receipt) {
                    $payment_method = $transaction->payment_gateway;
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
