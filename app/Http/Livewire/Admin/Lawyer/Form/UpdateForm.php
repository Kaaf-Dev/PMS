<?php

namespace App\Http\Livewire\Admin\Lawyer\Form;

use App\Models\Lawyer;
use App\Models\MaintenanceCompany;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateForm extends Component
{
    use WithAlert;

    public $lawyer;
    public $new_password;

    public function rules()
    {
        return [
            'lawyer.name' => 'required',
            'lawyer.email' => 'required|email',
            'lawyer.contact_name' => 'required',
            'lawyer.contact_phone' => 'required',
            'lawyer.contact_address' => 'required',
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
            'show-lawyer-update-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.lawyer.form.update-form');
    }

    public function resolveParams($params)
    {
        if (isset($params['lawyer'])) {
            $this->lawyer = Lawyer::findOrFail($params['lawyer']);
        }
    }

    public function submit()
    {
        $validated_data = $this->validate();
        if (isset($validated_data['new_password'])) {
            $validated_data['new_password'] = Hash::make($validated_data['new_password']);
            $this->lawyer->password = $validated_data['new_password'];
        }
        if ($this->lawyer->save()) {
            $this->emit('lawyer-updated');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeMe();
        } else {
            $this->showWarningAlert('يرجى التحقق من البيانات وإعادة المحاولة لاحقًا');
        }
    }

    public function discard()
    {
        $this->resetErrorBag();
        $this->lawyer->refresh();
        $this->reset([
            'new_password',
        ]);
    }

    public function closeMe()
    {
        $this->discard();
        $this->emit('hide-lawyer-update-modal');
    }

}
