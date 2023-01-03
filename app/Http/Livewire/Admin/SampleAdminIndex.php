<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class SampleAdminIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.sample-admin-index')
            ->layout('layouts.admin');
    }
}
