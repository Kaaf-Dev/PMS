<?php

namespace App\Http\Livewire\Admin\Ticket;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.ticket.index')
            ->layout('layouts.admin.app');
    }

    public function createTicket()
    {
        $this->emit('show-ticket-create-modal');
    }
}
