<?php

namespace App\Http\Livewire\Admin\MaintenanceCompany;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.maintenance-company.index')
            ->layout('layouts.admin.app');
    }
}
