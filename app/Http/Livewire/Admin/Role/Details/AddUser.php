<?php

namespace App\Http\Livewire\Admin\Role\Details;

use App\Models\Admin;
use App\Models\Role;
use App\Traits\WithAlert;
use Livewire\Component;

class AddUser extends Component
{
    use WithAlert;

    public $Role;
    public $user_role_selected = [];
    public $admins = [];

    public function getListeners()
    {
        return [
            'show-add-user-role-modal' => 'resolveParams'
        ];
    }

    public function rules()
    {
        return [
            'user_role_selected' => 'required',
        ];
    }

    public function resolveParams($params)
    {
        $this->resetFields();
        if (isset($params['role_id'])) {
            $this->Role = Role::findOrFail($params['role_id']);
            if ($this->Role) {
                $this->user_role_selected = $this->Role->admins()->get()->pluck('id')->toArray();
                $this->admins = Admin::all();
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.role.details.add-user');
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset();
    }

    public function save()
    {
        $this->validate();
        $user_role_selected = collect($this->user_role_selected)->filter(function ($value) {
            return $value != 0;
        });
        $this->Role->admins()->sync($user_role_selected);
        $this->discard();
        $this->showSuccessAlert('تمت عملية الحفظ بنجاح');
        $this->emit('admin-role-updated');
    }

    public function discard()
    {
        $this->emit('hide-add-user-role-modal');
    }
}
