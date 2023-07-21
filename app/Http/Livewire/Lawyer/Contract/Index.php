<?php

namespace App\Http\Livewire\Lawyer\Contract;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.lawyer.contract.index')
            ->layout('layouts.lawyer.app');
    }
}
