<?php

namespace App\Console\Commands;

use App\Models\Contract;
use App\Models\Invoice;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BenefitPayCheckStatusDown extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benefit:down';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check benefit status down';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        info('[Executing Job - ' . date('Y-m-d H:i:sa') . ']: Check Benefit Status Down ');
        $down_transaction = PaymentTransaction::DownTransaction()->get();
        foreach ($down_transaction as $transaction) {
            dispatch(new \App\Jobs\BenefitPayCheckStatusDown($transaction->trx_id, $transaction->Invoice->payment_gateway));
        }

    }


}
