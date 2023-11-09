<?php

namespace App\Http\Livewire\Admin\Ticket\Details;

use App\Models\Ticket;
use Livewire\Component;

class Rating extends Component
{

    public $ticket_id;

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.admin.ticket.details.rating');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }

}
