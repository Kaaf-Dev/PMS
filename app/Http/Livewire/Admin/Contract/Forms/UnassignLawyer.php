<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Contract;
use App\Traits\WithAlert;
use Livewire\Component;

class UnassignLawyer extends Component
{
    use WithAlert;
    public $contract;

    public function getListeners()
    {
        return [
            'show-contract-unassign-lawyer-modal' => 'selectContract',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.unassign-lawyer');
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
        $this->emit('hide-contract-unassign-lawyer-modal');
    }

    public function unassign()
    {
        $this->contract->lawyer_id = null;
        if ($this->contract->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-lawyer-unassigned');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }
    }



}
