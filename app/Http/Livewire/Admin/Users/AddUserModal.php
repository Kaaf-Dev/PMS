<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Nationality;
use App\Models\User;
use App\Traits\WithWizard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddUserModal extends Component
{
    use WithFileUploads;
    use WithWizard;

    public  $user_image,
            $user_name,
            $user_type = 1,
            $user_email,
            $user_cpr,
            $user_nationality_id,
            $corporate_id,
            $contact_name,
            $contact_phone;

    public $user_id;

    public function rules()
    {
        $rules = [
            '1' => [
                'user_type' => 'required|integer',
            ],

            '2' => [
                'user_nationality_id' => [
                    'nullable',
                    'exists:nationalities,id',
                    Rule::requiredIf($this->user_type == 1),
                ],
                'user_image' => 'nullable|mimes:jpeg,png,jpg',
                'user_name' => 'required',
                'user_email' => 'nullable|email|unique:users,email',
                'user_cpr' => 'nullable',
                'corporate_id' => Rule::requiredIf($this->user_type == 2),
                'contact_name' => Rule::requiredIf($this->user_type == 2),
                'contact_phone' => Rule::requiredIf($this->user_type == 2),
            ]
        ];

        if ($this->user_type == 1) {
            if ($this->user_nationality_id == 1) {
                $rules['2']['user_cpr'] = 'required|digits:9';
            } else {
                $rules['2']['user_cpr'] = 'required|numeric';
            }
        }
        return $rules[$this->step ?? 1];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'required_if' => 'هذا الحقل إجباري',
            'digits' => 'القيمة غير صالحة',
            'user_email.unique' => 'البريد الإلكتروني مسجل بالفعل!',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function getListeners()
    {
        return [
            'show-user-add-modal' => 'resetFields'
        ];
    }

    public function render()
    {
        return view('livewire.admin.users.add-user-modal');
    }

    public function getNationalitiesProperty()
    {
        return Nationality::all();
    }

    public function next()
    {
        $this->validate();

        if ($this->step == 2) { // to save user
            $this->validate();
            $password = Str::random(8);
            $password = Hash::make($password);
            $user = new User();
            $user->name = $this->user_name;
            $user->email = $this->user_email;
            $user->user_type = $this->user_type;
            $user->cpr = $this->user_cpr;
            $user->nationality_id = $this->user_nationality_id;
            $user->password = $password;
            $user->corporate_id = $this->corporate_id;
            $user->contact_name = $this->contact_name;
            $user->contact_phone = $this->contact_phone;
            if (isset($this->user_image)) {
                $user->user_image_path = $this->user_image->store($this->user_cpr, 'user_image');
            }
            $user->generateUserName();
            $user->save();
            $this->user_id = $user->id;
            $this->emit('user-added');
        }

        $this->nextStep();
    }

    public function newUser()
    {
        $this->resetFields();
    }

    public function assignContract(){
        $this->emit('show-contract-new-modal', [
            'user' => $this->user_id,
        ]);
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->emit('hide-user-add-modal');
    }

    public function resetFields()
    {
        $this->reset([
            'user_image',
            'user_name',
            'user_type',
            'user_email',
            'user_cpr',
            'corporate_id',
            'contact_name',
            'contact_phone',
        ]);
        $this->step = 1;
    }
}
