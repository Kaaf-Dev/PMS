<?php

namespace App\Http\Livewire\Admin\Staff\Forms;

use App\Models\Admin;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use WithAlert;

    public $name, $username, $password;

    public function getListeners()
    {
        return [
            'show-add-admin-modal' => 'resetParams'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => [Rule::unique('admins', 'username'), 'required', 'email'],
            'password' => 'required|min:8',
        ];
    }

    public function resetParams()
    {
        $this->resetFields();
    }

    public function render()
    {
        return view('livewire.admin.staff.forms.create');
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset();
    }

    public function updatePassword()
    {
        $this->password = Str::random(8);
    }

    public function save()
    {
        $data = $this->validate();
        $data['password'] = Hash::make($data['password']);
        $admin = new Admin($data);
        if ($admin->save()) {
            dispatch(new \App\Jobs\AdminLoginDetails($admin, $this->password));
            $this->emit('staff-updated');
            $this->showSuccessAlert('تمت عملية الحفظ بنجاح');
            $this->discard();
        } else {
            $this->showErrorAlert('فشلت عملية الحفظ');
        }
    }

    public function discard()
    {
        $this->emit('hide-add-admin-modal');
    }
}
