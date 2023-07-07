<?php

namespace App\Http\Livewire\User\Ticket\Details;

use App\Models\Ticket;
use Livewire\Component;

class Overview extends Component
{

    public $ticket_id;

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.user.ticket.details.overview');
    }

    public function getTicketProperty()
    {
        return Ticket::with([
            'contract',
            'ticketAttachments',
        ])->findOrFail($this->ticket_id);
    }
}
