<?php

namespace App\Http\Livewire\User\Contract;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user.contract.index')
            ->layout('layouts.user.app');
    }
}
