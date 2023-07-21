<?php

namespace App\Http\Livewire\Lawyer\Contract\Details;

use App\Models\Invoice;
use Livewire\Component;

class InvoicesList extends Component
{

    public $contract_id;

    public function mount($contract)
    {
        $this->contract_id = $contract;
    }

    public function render()
    {
        return view('livewire.lawyer.contract.details.invoices-list');
    }

    public function getInvoicesProperty()
    {
        $invoices = Invoice::where([
            ['contract_id', '=', $this->contract_id]
        ])->orderBy('date', 'desc')
            ->get();

        return $invoices->groupBy(function ($item, $key) { // arrange by year
            return $item->date->format('Y');
        });
    }
}
