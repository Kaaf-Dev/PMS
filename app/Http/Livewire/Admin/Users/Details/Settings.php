<?php

namespace App\Http\Livewire\Admin\Users\Details;

use App\Traits\WithAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{

    use WithFileUploads;
    use WithAlert;

    public $User;
    public $user_image_path;

    public function rules()
    {
        return [
            'User.name' => 'required',
            'User.email' => 'required|email',
            'User.phone' => 'required',
            'User.whatsapp_phone' => 'nullable',
            'User.user_type' => 'required|integer',
            'User.gender' => Rule::requiredIf($this->User->is_person),
            'User.cpr' => Rule::requiredIf($this->User->is_person),
            'User.corporate_id' => Rule::requiredIf($this->User->is_corporate),
            'User.contact_name' => Rule::requiredIf($this->User->is_corporate),
            'User.contact_phone' => Rule::requiredIf($this->User->is_corporate),
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'integer' => 'القيمة غير صالحة',
            'email' => 'البريد الإلكتروني غير صالح',
        ];
    }

    public function mount($User)
    {
        $this->User = $User;
    }

    public function render()
    {
        return view('livewire.admin.users.details.settings');
    }

    public function save()
    {
        $this->validate();
        if (isset($this->user_image_path)) {
            $this->User->user_image_path = $this->user_image_path->store($this->User->cpr, 'user_image');
        }

        $this->User->save();
        $this->showSuccessAlert('تمت العملية بنجاح');
        $this->emit('userUpdated');
    }
}
