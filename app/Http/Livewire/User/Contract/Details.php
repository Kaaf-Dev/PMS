<?php

namespace App\Http\Livewire\User\Contract;

use App\Models\Contract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Details extends Component
{

    use AuthorizesRequests;

    public $contract_id;

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.user.contract.details')
            ->layout('layouts.user.app');
    }

    public function getContractProperty()
    {
        $contract = Contract::with('apartments')
            ->findOrFail($this->contract_id);

        if ( $this->authorize('view', $contract) ) {
            return $contract;
        }
    }
}
