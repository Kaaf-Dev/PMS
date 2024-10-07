<?php

namespace App\Http\Livewire\Admin\Users\Details;

use App\Models\Nationality;
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
        $rules = [
            'User.nationality_id' => [
                'nullable',
                'exists:nationalities,id',
                Rule::requiredIf($this->User->user_type == 1),
            ],
            'User.name' => 'required',
            'User.email' => 'nullable|email|unique:users,email,' . $this->User->id,
            'User.phone' => Rule::requiredIf($this->User->is_person),
            'User.whatsapp_phone' => 'nullable',
            'User.user_type' => 'required|integer',
            'User.gender' => Rule::requiredIf($this->User->is_person),
            'User.cpr' => 'nullable',
            'User.key_id' => 'nullable',
            'User.corporate_id' => Rule::requiredIf($this->User->is_corporate),
            'User.contact_name' => Rule::requiredIf($this->User->is_corporate),
            'User.contact_phone' => Rule::requiredIf($this->User->is_corporate),
        ];

        if ($this->User->is_person) {
            if ($this->User->is_bahrinian) {
                $rules['User.cpr'] = 'required|digits:9';
            } else {
                $rules['User.cpr'] = 'required|numeric';
            }
        }

        return $rules;
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'required_if' => 'هذا الحقل إجباري',
            'digits' => 'القيمة غير صالحة',
            'User.email.unique' => 'البريد الإلكتروني مسجل بالفعل!',
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

    public function getNationalitiesProperty()
    {
        return Nationality::all();
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
