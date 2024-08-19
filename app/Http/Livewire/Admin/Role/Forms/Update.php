<?php

namespace App\Http\Livewire\Admin\Role\Forms;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\WithAlert;
use Livewire\Component;

class Update extends Component
{
    use WithAlert;

    public $Role;
    public $permissions = [];
    public $role_permission = [];

    public function getListeners()
    {
        return [
            'show-admin-update-role-modal' => 'resolveParams'
        ];
    }

    public function rules()
    {
        return [
            'Role.name' => 'required',
            'role_permission.*' => 'required',
        ];
    }

    public function resolveParams($params)
    {
        $this->resetFields();
        if (isset($params['role_id'])) {
            $this->Role = Role::findOrFail($params['role_id']);
            if ($this->Role) {
                $this->role_permission = $this->Role->permissions()->get()->pluck('id', 'id')->toArray();
                $this->permissions = Permission::all();
            }

        } else {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.admin.role.forms.update');
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset();
    }

    public function save()
    {
        $this->validate();
        if ($this->Role->save()) {
            $selected_permission = collect($this->role_permission)->filter(function ($value) {
                return $value != 0;
            });
            $this->Role->permissions()->sync($selected_permission);
            $this->discard();
            $this->emit('role-list-updated');
            $this->showSuccessAlert("تم الحفظ بنجاح");
        } else {
            $this->showErrorAlert("حدث خطأ غير متوقع");
        }
    }

    public function discard()
    {
        $this->emit('hide-admin-update-role-modal');
    }
}
