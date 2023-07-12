<?php

namespace App\Http\Livewire\Admin\Ticket\Details;

use App\Models\Ticket;
use Livewire\Component;

class Info extends Component
{

    public $ticket_id;

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.admin.ticket.details.info');
    }

    public function getTicketProperty()
    {
        return Ticket::with([
            'contract',
            'contract.user',
            'contract.apartments',
            'contract.apartments.property',
            'ticketAttachments',
        ])->findOrFail($this->ticket_id);
    }
}
