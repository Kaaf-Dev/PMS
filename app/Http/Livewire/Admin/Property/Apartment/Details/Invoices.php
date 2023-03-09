<?php

namespace App\Http\Livewire\Admin\Property\Apartment\Details;

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

//    public function get
}
