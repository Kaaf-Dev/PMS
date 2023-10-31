<?php

namespace App\Http\Livewire\Maintenance\Ticket;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.maintenance.ticket.index')
            ->layout('layouts.maintenance.app');
    }
}
