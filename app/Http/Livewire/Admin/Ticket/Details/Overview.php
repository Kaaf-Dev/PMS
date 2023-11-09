<?php

namespace App\Http\Livewire\Admin\Ticket\Details;

use App\Models\Ticket;
use Livewire\Component;

class Overview extends Component
{
    public $ticket_id;

    public function getListeners()
    {
        return [
            'ticket-updated' => '$refresh',
            'reply-added' => '$refresh',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.admin.ticket.details.overview');
    }

    public function getTicketProperty()
    {
        return Ticket::with([
            'contract',
            'ticketAttachments',
        ])->findOrFail($this->ticket_id);
    }
}
