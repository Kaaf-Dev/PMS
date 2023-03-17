<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Contract;
use App\Models\User;
use App\Traits\WithAlert;
use Livewire\Component;

class ManageUser extends Component
{
    use WithAlert;

    public $contract;
    public $users;
    public $selected_user;
    public $search_user;

    public function rules()
    {
        return [
            'selected_user' => 'required',
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
            'show-contract-manage-user-modal' => 'selectContract',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.manage-user');
    }

    public function updated($property)
    {
        if ($property == 'search_user') {
            $this->fetchUsers();
        }

    }

    public function selectContract($params = [])
    {
        $this->resetFields();
        $contract_id = $params['contract_id'] ?? 0;
        $this->contract = Contract::findOrFail($contract_id);
        $this->selected_user = $this->contract->User;
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        $search_user = $this->search_user;
        $this->users = User::where(function($query) use ($search_user){
            $query->where('name', 'LIKE', '%'. $search_user .'%')
                ->orWhere('email', 'LIKE', '%'.$search_user.'%')
                ->orWhere('cpr', 'LIKE', '%'.$search_user.'%');
        })
            ->limit(15)
            ->get();
    }

    public function selectUser($user = null)
    {
        $this->reset([
            'search_user',
            'selected_user',
        ]);
        if ($user) {
            $this->selected_user = User::findOrFail($user);
        }
    }

    public function clearSearchUser()
    {
        $this->reset('search_user');
        $this->fetchUsers();
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'contract',
            'selected_user',
            'users',
            'search_user',
        ]);
    }

    public function closeModal()
    {
        $this->emit('hide-contract-manage-user-modal');
    }

    public function save()
    {
        $validated_data = $this->validate();
        $this->contract->user_id = $this->selected_user->id;
        if ($this->contract->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-updated-user');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }
    }

}
