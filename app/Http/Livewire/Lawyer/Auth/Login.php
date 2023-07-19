<?php

namespace App\Http\Livewire\Lawyer\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $username;
    public $password;

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.auth.login')
            ->layout('layouts.lawyer.auth');
    }

    public function login()
    {
        $validated_data = $this->validate();
        $username = $validated_data['username'];
        $password = $validated_data['password'];

        if (Auth::guard('lawyer')->attempt(['username' => $username, 'password' => $password])) {
            return redirect()->intended(route('lawyer.dashboard'));
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
