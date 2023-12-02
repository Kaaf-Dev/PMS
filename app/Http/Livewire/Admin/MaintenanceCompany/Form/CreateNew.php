<?php

namespace App\Http\Livewire\Admin\MaintenanceCompany\Form;

use App\Models\MaintenanceCompany;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateNew extends Component
{

    use WithAlert;

    public $name;
    public $email;
    public $contact_name;
    public $contact_phone;
    public $contact_address;
    public $username;
    public $password;

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'contact_address' => 'required',
            'username' => 'required|unique:maintenance_companies,username',
            'password' => 'required',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'username.required' => 'اسم المستخدم هذا مستخدم من قِبل',
        ];
    }

    public function render()
    {
        return view('livewire.admin.maintenance-company.form.create-new');
    }

    public function submit()
    {
        $validated_data = $this->validate();
        $validated_data['password'] = Hash::make($validated_data['password']);
        $maintenance_company = new MaintenanceCompany($validated_data);
        if ($maintenance_company->save()) {
            $this->emit('maintenance-company-added');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeMe();
        } else {
            $this->showWarningAlert('يرجى التحقق من البيانات وإعادة المحاولة لاحقًا');
        }
    }

    public function discard()
    {
        $this->resetErrorBag();
        $this->reset([
            'name',
            'contact_name',
            'contact_phone',
            'contact_address',
            'username',
            'password',
        ]);
    }

    public function closeMe()
    {
        $this->discard();
        $this->emit('hide-maintenance-company-create-modal');
    }
}
