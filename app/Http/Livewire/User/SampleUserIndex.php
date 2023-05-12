<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class SampleUserIndex extends Component
{
    public function render()
    {
        return view('livewire.user.sample-user-index')
            ->layout('layouts.user.app');
    }
}
