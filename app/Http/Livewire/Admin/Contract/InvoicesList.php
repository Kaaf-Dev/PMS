<?php

namespace App\Http\Livewire\Admin\Contract;

use App\Models\Invoice;
use Livewire\Component;

class InvoicesList extends Component
{
    public $contract_id;

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.admin.contract.invoices-list');
    }

    public function getInvoicesProperty()
    {
        $invoices = Invoice::where([
            ['contract_id', '=', $this->contract_id]
        ])->get();

        return $invoices->groupBy(function ($item, $key) { // arrange by year
            return $item->date->format('Y');
        });
    }
}
