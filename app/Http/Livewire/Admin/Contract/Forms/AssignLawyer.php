<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Contract;
use App\Models\Lawyer;
use App\Models\LawyerCase;
use App\Traits\WithAlert;
use Livewire\Component;

class AssignLawyer extends Component
{
    use WithAlert;

    public $contract;
    public $lawyers;
    public $selected_lawyer;

    public $subject;
    public $first_side;
    public $second_side;
    public $amount;
    public $needed_action;

    public $search;

    public function rules()
    {
        return [
            'selected_lawyer' => 'required',
            'subject' => 'required',
            'first_side' => 'required',
            'second_side' => 'required',
            'amount' => 'required',
            'needed_action' => 'required',
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
        $this->amount = $this->contract->total_amount_remaining;
        $this->first_side = $this->contract->first_side;
        $this->second_side = $this->contract->second_side;
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
            'subject',
            'first_side',
            'second_side',
            'amount',
            'needed_action',
        ]);
    }

    public function closeModal()
    {
        $this->emit('hide-contract-assign-lawyer-modal');
    }

    public function save()
    {
        $validated_data = $this->validate();

        $lawyer_case = new LawyerCase();
        $lawyer_case->lawyer_id = $this->selected_lawyer->id;
        $lawyer_case->contract_id = $this->contract->id;
        $lawyer_case->subject = $validated_data['subject'];
        $lawyer_case->needed_action = $validated_data['needed_action'];
        $lawyer_case->first_side = $validated_data['first_side'];
        $lawyer_case->second_side = $validated_data['second_side'];
        $lawyer_case->amount = $validated_data['amount'];

        if ($lawyer_case->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-lawyer-assigned');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }
    }



}
