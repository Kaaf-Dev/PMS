<?php

namespace App\Http\Livewire\Admin\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class Summary extends Component
{

    public $contract_id;

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.admin.contract.details.summary');
    }

    public function getContractProperty()
    {
        return Contract::findOrFail($this->contract_id);
    }

    public function manageRentalCost()
    {
        $this->emit('show-contract-update-rental-cost-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

}
