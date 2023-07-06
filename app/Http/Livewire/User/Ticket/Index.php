<?php

namespace App\Http\Livewire\User\Ticket;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user.ticket.index')
            ->layout('layouts.user.app');
    }

    public function newTicket()
    {
        return $this->emit('show-user-ticket-create-modal');
    }
}
