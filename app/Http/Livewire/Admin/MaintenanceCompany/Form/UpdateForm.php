<?php

namespace App\Http\Livewire\Admin\MaintenanceCompany\Form;

use App\Models\MaintenanceCompany;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateForm extends Component
{
    use WithAlert;

    public $maintenance_company;
    public $new_password;

    public function rules()
    {
        return [
            'maintenance_company.name' => 'required',
            'maintenance_company.email' => 'required|email',
            'maintenance_company.contact_name' => 'required',
            'maintenance_company.contact_phone' => 'required',
            'maintenance_company.contact_address' => 'required',
            'new_password' => 'nullable',
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
            'show-maintenance-company-update-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.maintenance-company.form.update-form');
    }

    public function resolveParams($params)
    {
        if (isset($params['maintenance_company'])) {
            $this->maintenance_company = MaintenanceCompany::findOrFail($params['maintenance_company']);
        }
    }

    public function submit()
    {
        $validated_data = $this->validate();
        if (isset($validated_data['new_password'])) {
            $validated_data['new_password'] = Hash::make($validated_data['new_password']);
            $this->maintenance_company->password = $validated_data['new_password'];
        }
        if ($this->maintenance_company->save()) {
            $this->emit('maintenance-company-updated');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeMe();
        } else {
            $this->showWarningAlert('يرجى التحقق من البيانات وإعادة المحاولة لاحقًا');
        }
    }

    public function discard()
    {
        $this->resetErrorBag();
        $this->maintenance_company->refresh();
        $this->reset([
            'new_password',
        ]);
    }

    public function closeMe()
    {
        $this->discard();
        $this->emit('hide-maintenance-company-update-modal');
    }

}
