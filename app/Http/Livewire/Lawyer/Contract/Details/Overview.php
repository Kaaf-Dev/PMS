<?php

namespace App\Http\Livewire\Lawyer\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class Overview extends Component
{

    public $contract_id;

    public function mount($contract)
    {
        $this->contract_id = $contract;
    }

    public function render()
    {
        return view('livewire.lawyer.contract.details.overview');
    }

    public function getContractProperty()
    {
        return Contract::with([
            'apartments',
            'apartments.property',
            'user'
        ])
            ->findOrFail($this->contract_id);
    }


}
