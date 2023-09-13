<?php

namespace App\Console\Commands;

use App\Models\Contract;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateMonthlyInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:monthly-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly invoices for contracts';

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
        // Get all contracts that are eligible for monthly invoices
        $contracts = Contract::all();

        foreach ($contracts as $contract) {

            $start_date = Carbon::parse($contract->start_at);

            $contract_end_date = Carbon::parse($contract->end_at);
            $now_end_date = Carbon::now();

            if ($contract_end_date->gt($now_end_date)) {
                $end_date = $now_end_date;
            } else {
                $end_date = $contract_end_date;
            }

            while ($start_date <= $end_date) {

                if (!$this->hasInvoice($contract, $start_date)) {

                    $invoice = new Invoice([
                        'contract_id' => $contract->id,
                        'amount' => $contract->cost,
                        'date' => $start_date->format('Y-m-1'),
                        'due' => $start_date->format('Y-m-15'),
                        'type' => 1,
                    ]);

                    $invoice->save();
                }

                $start_date->addMonth();
            }
        }

        $this->info('Monthly invoices generated successfully.');
    }

    private function hasInvoice($contract, $date)
    {
        return $contract->invoices()
            ->whereYear('date', $date->year)
            ->whereMonth('date', $date->month)
            ->where('type', 1)
            ->exists();
    }

}
