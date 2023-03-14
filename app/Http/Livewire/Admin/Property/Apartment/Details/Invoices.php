<?php

namespace App\Http\Livewire\Admin\Property\Apartment\Details;

use App\Models\Invoice;
use Livewire\Component;

class Invoices extends Component
{
    public $contract_id;

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.admin.property.apartment.details.invoices');
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
