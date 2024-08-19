<?php

namespace App\Http\Livewire\Admin\Role\Forms;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\WithAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use WithAlert;

    public $permissions = [];
    public $role_permission = [];
    public $role_name;

    public function getListeners()
    {
        return [
            'show-admin-create-role-modal' => 'resolveParams'
        ];
    }

    public function rules()
    {
        return [
            'role_name' => 'required',
            'role_permission' => [Rule::exists('permissions', 'id'), 'required'],
        ];
    }

    public function resolveParams()
    {
        $this->resetFields();
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.admin.role.forms.create');
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset();
    }

    public function save()
    {
        $this->validate();
        $role = new Role();
        $role->name = $this->role_name;
        if ($role->save()) {
            $role->permissions()->attach($this->role_permission);
            $this->discard();
            $this->emit('role-list-updated');
            $this->showSuccessAlert("تم الحفظ بنجاح");
        } else {
            $this->showErrorAlert("حدث خطأ غير متوقع");
        }
    }

    public function discard()
    {
        $this->emit('hide-admin-create-role-modal');
    }
}
