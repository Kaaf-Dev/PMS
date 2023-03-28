<?php

namespace App\Http\Livewire\Admin\Contract\Details;

use App\Models\Invoice;
use Livewire\Component;

class InvoicesList extends Component
{
    public $contract_id;

    public function getListeners()
    {
        return [
            'invoice_added' => '$refresh',
        ];
    }

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.admin.contract.details.invoices-list');
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
