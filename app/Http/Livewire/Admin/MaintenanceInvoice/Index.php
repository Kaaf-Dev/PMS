<?php

namespace App\Http\Livewire\Admin\MaintenanceInvoice;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.maintenance-invoice.index')
            ->layout('layouts.admin.app');
    }
}
