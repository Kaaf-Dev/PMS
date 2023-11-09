<?php

namespace App\Http\Livewire\Admin\Lawyer;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.lawyer.index')
            ->layout('layouts.admin.app');
    }
}
