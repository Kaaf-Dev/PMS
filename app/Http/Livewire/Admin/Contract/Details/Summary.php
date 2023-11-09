<?php

namespace App\Http\Livewire\Admin\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class Summary extends Component
{
    public $contract_id;

    public function getListeners()
    {
        return [
            'contract-updated-user' => '$refresh',
            'contract-updated-apartment' => '$refresh',
            'contract-canceled' => '$refresh',
            'contract-lawyer-assigned' => '$refresh',
            'contract-lawyer-unassigned' => '$refresh',
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
        return Contract::with('lawyerCase')
            ->findOrFail($this->contract_id);
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

    public function reactiveContract()
    {
        $this->emit('show-contract-active-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

    public function createInvoice()
    {
        $this->emit('show-invoice-create-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

    public function assignLawyer()
    {
        $this->emit('show-contract-assign-lawyer-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

    public function unassignLawyer()
    {
        $this->emit('show-contract-unassign-lawyer-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

    public function payInvoice()
    {
        $this->emit('show-admin-receipt-create-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }

}
