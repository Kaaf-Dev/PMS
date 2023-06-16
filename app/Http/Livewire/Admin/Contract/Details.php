<?php

namespace App\Http\Livewire\Admin\Contract;

use App\Models\Contract;
use Livewire\Component;

class Details extends Component
{

    public $contract_id;

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.admin.contract.details')
            ->layout('layouts.admin.app');
    }

    public function getContractProperty()
    {
        return Contract::with('apartments')
            ->findOrFail($this->contract_id);
    }
}
