<?php

namespace App\Http\Livewire\Maintenance\Ticket\Details;

use App\Models\Ticket;
use Livewire\Component;

class FinishTicketBtn extends Component
{
    public $ticket_id;

    public function getListeners()
    {
        return [
            'ticket-updated' => '$refresh',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.maintenance.ticket.details.finish-ticket-btn');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }

    public function finishTicket()
    {
        $this->emit('show-maintenance-ticket-finish-modal', [
            'ticket_id' => $this->ticket_id,
        ]);
    }
}
