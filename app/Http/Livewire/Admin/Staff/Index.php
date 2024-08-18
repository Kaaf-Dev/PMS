<?php

namespace App\Http\Livewire\Admin\Staff;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.staff.index')
            ->layout('layouts.admin.app');
    }
}
