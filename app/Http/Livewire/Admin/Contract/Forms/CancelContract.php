<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Contract;
use App\Traits\WithAlert;
use Livewire\Component;

class CancelContract extends Component
{
    use WithAlert;

    public $contract;

    public function getListeners()
    {
        return [
            'show-contract-cancel-modal' => 'selectContract',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.cancel-contract');
    }

    public function selectContract($params = [])
    {
        $this->resetFields();
        $contract_id = $params['contract_id'] ?? 0;
        $this->contract = Contract::findOrFail($contract_id);
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'contract',
        ]);
    }

    public function closeModal()
    {
        $this->emit('hide-contract-cancel-modal');
    }

    public function save()
    {
        if ($this->contract->cancel()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-canceled');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }
    }

}
