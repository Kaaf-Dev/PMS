<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddUserModal extends Component
{
    use WithFileUploads;

    public $user_image, $user_name, $user_type = 1, $user_email, $user_cpr;

    public function rules()
    {
        $rules = [];
        $rules['user_image'] = 'nullable|mimes:jpeg,png,jpg';
        $rules['user_name'] = 'required';
        $rules['user_type'] = 'required|integer';
        $rules['user_email'] = 'required|email|unique:users,email';
        $rules['user_cpr'] = 'required|digits:9';
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.users.add-user-modal');
    }

    public function save()
    {
        $this->validate();
        $password = Str::random(8);
        $password = Hash::make($password);
        $user = new User();
        $user->name = $this->user_name;
        $user->email = $this->user_email;
        $user->user_type = $this->user_type;
        $user->cpr = $this->user_cpr;
        $user->password = $password;
        if (isset($this->user_image)) {
            $user->user_image_path = $this->user_image->store($this->user_cpr, 'user_image');
        }
        $user->save();
        return redirect()->route('admin.users.details', $user->id);
    }

    public function closeModal()
    {
        $this->emit('hideAddUserModel');
    }
}
