<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $username;
    public $password;

    public function rules()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        return $rules;
    }

    public function render()
    {
        return view('livewire.admin.auth.login')
            ->layout('layouts.admin.auth');
    }

    public function login()
    {
        $validated_data = $this->validate();
        $username = $validated_data['username'];
        $password = $validated_data['password'];

        if (Auth::guard('admin')->attempt(['username' => $username, 'password' => $password])) {
            return redirect()->intended(route('admin.dashboard'));
        }

        $this->addError('username', 'The provided credentials are incorrect.');
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->reset([
            'password',
        ]);
    }
}
