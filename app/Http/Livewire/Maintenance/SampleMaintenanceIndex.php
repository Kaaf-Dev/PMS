<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;

class SampleMaintenanceIndex extends Component
{
    public function render()
    {
        return view('livewire.maintenance.sample-maintnenace-index')
            ->layout('layouts.maintenance.app');
    }
}
