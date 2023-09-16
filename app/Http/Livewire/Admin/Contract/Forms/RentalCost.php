<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Contract;
use App\Traits\WithAlert;
use Livewire\Component;

class RentalCost extends Component
{

    use WithAlert;

    public $contract;
    public $selected_apartments;

    public function rules()
    {
        return [
            'selected_apartments.*.cost' => 'required|numeric',
        ];
    }

    public function getListeners()
    {
        return [
            'show-contract-update-rental-cost-modal' => 'selectContract',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.rental-cost');
    }

    public function selectContract($params = [])
    {
        $this->resetFields();
        $contract_id = $params['contract_id'] ?? 0;
        $this->contract = Contract::findOrFail($contract_id);
        $this->selected_apartments = $this->contract->contractApartments;
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'contract',
            'selected_apartments',
        ]);
    }

    public function closeModal()
    {
        $this->emit('hide-contract-update-rental-cost-modal');
    }

    public function save()
    {
        $this->validate();
        foreach ($this->selected_apartments as $selected_apartment) {
            $selected_apartment->save();
        }
        $this->showSuccessAlert('تمت العملية بنجاح');
        $this->emit('contract-updated-rental-cost');
        $this->closeModal();
    }
}
