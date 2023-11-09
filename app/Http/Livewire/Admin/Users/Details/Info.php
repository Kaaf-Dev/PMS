<?php

namespace App\Http\Livewire\Admin\Users\Details;

use Livewire\Component;

class Info extends Component
{
    public $user;

    public function getListeners()
    {
        return [
            'userUpdated' => '$refresh',
        ];
    }

    public function mount($user)
    {
        $this->fill([
            'user' => $user,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.users.details.info');
    }
}
