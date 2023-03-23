<?php

namespace App\Http\Livewire\Admin\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class Summary extends Component
{
// todo: add checks for activation contracts
    public $contract_id;

    public function getListeners()
    {
        return [
            'contract-updated-user' => '$refresh',
            'contract-updated-apartment' => '$refresh',
        ];
    }

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

    public function manageUser()
    {
        $this->emit('show-contract-manage-user-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

    public function manageApartment()
    {
        $this->emit('show-contract-manage-apartment-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

    public function updateDuration()
    {
        $this->emit('show-contract-update-duration-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

    public function cancelContract()
    {
        $this->emit('show-contract-cancel-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

}
