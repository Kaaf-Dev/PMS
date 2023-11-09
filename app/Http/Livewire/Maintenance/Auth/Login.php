<?php

namespace App\Http\Livewire\Maintenance\Auth;

use App\Models\Admin;
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
        return view('livewire.maintenance.auth.login')
            ->layout('layouts.maintenance.auth');
    }

    public function login()
    {
        $validated_data = $this->validate();
        $username = $validated_data['username'];
        $password = $validated_data['password'];

        if (Auth::guard('maintenance_company')->attempt(['username' => $username, 'password' => $password])) {
            return redirect()->intended(route('maintenance.dashboard'));
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
