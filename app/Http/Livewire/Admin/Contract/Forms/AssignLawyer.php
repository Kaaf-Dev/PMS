<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Contract;
use App\Models\Lawyer;
use App\Traits\WithAlert;
use Livewire\Component;

class AssignLawyer extends Component
{
    use WithAlert;

    public $contract;
    public $lawyers;
    public $selected_lawyer;
    public $search;


    public function rules()
    {
        return [
            'selected_lawyer' => 'required',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
        ];
    }

    public function getListeners()
    {
        return [
            'show-contract-assign-lawyer-modal' => 'selectContract',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.assign-lawyer');
    }

    public function updated($property)
    {
        if ($property == 'search') {
            $this->fetchLawyers();
        }

    }

    public function selectContract($params = [])
    {
        $this->resetFields();
        $contract_id = $params['contract_id'] ?? 0;
        $this->contract = Contract::findOrFail($contract_id);
        $this->fetchLawyers();
    }

    public function fetchLawyers()
    {
        $search = $this->search;
        $this->lawyers = Lawyer::where(function($query) use ($search){
            $query->where('name', 'LIKE', '%'. $search .'%')
                ->orWhere('contact_name', 'LIKE', '%'.$search.'%')
                ->orWhere('contact_phone', 'LIKE', '%'.$search.'%')
                ->orWhere('contact_address', 'LIKE', '%'.$search.'%');
        })
            ->limit(15)
            ->get();
    }

    public function selectLawyer($user = null)
    {
        $this->reset([
            'search',
            'selected_lawyer',
        ]);
        if ($user) {
            $this->selected_lawyer = Lawyer::findOrFail($user);
        }
    }

    public function clearSearchLawyer()
    {
        $this->reset('search');
        $this->fetchLawyer();
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'contract',
            'selected_lawyer',
            'lawyers',
            'search',
        ]);
    }

    public function closeModal()
    {
        $this->emit('hide-contract-assign-lawyer-modal');
    }

    public function save()
    {
        $validated_data = $this->validate();
        $this->contract->lawyer_id = $this->selected_lawyer->id;
        if ($this->contract->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-lawyer-assigned');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }
    }



}
