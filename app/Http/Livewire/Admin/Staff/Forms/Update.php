<?php

namespace App\Http\Livewire\Admin\Staff\Forms;

use App\Models\Admin;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    use WithAlert;

    public $Admin;
    public $password;

    public function getListeners()
    {
        return [
            'show-update-admin-modal' => 'restParams'
        ];
    }

    public function rules()
    {
        return [
            'Admin.name' => 'required',
            'Admin.username' => [Rule::unique('admins', 'username')->ignore($this->Admin->id), 'required', 'email'],
            'password' => 'nullable|min:8',
        ];
    }

    public function restParams($params)
    {
        $this->resetFields();
        if (isset($params['admin_id'])) {
            $this->Admin = Admin::findOrFail($params['admin_id']);
        } else {
            abort(404);
        }
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.staff.forms.update');
    }

    public function updatePassword()
    {
        $this->password = Str::random(8);
    }


    public function save()
    {
        $this->validate();
        if ($this->password) {
            $this->Admin->password = Hash::make($this->password);
        }
        if ($this->Admin->save()) {
            $this->emit('staff-updated');
            $this->discard();
            $this->showSuccessAlert('تمت عملية الحفظ بنجاح');
        }else{
            $this->showErrorAlert('حدث خطأ');
        }
    }

    public function discard()
    {
        $this->emit('hide-update-admin-modal');
    }
}
