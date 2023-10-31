<?php

namespace App\Http\Livewire\Admin\Users\Details;

use App\Models\User;
use Livewire\Component;

class ContractsCard extends Component
{
    public $User;

    public function mount($user_id = null)
    {
        $this->User = User::findOrFail($user_id);
    }

    public function render()
    {
        return view('livewire.admin.users.details.contracts-card');
    }

    public function getContractsProperty()
    {
        return $this->User->contracts()->with('apartments')->get();
    }
}
