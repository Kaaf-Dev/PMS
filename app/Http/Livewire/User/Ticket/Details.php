<?php

namespace App\Http\Livewire\User\Ticket;

use Livewire\Component;

class Details extends Component
{
    public function render()
    {
        return view('livewire.user.ticket.details')
            ->layout('layouts.user.app');
    }
}
