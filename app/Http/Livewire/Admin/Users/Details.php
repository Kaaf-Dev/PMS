<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Details extends Component
{

    public $user_id;

    public function mount($user_id)
    {
        $this->fill([
            'user_id' => $user_id,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.users.details')
            ->layout('layouts.admin.app');
    }

    public function getUserProperty()
    {
        $User = User::find($this->user_id);
        if ($User) {
            return $User;
        }
        abort(404);
    }
}
