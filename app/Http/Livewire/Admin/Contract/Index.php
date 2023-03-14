<?php

namespace App\Http\Livewire\Admin\Contract;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.contract.index')
            ->layout('layouts.admin.app');

    }
}
