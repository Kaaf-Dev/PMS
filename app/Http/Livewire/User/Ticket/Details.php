<?php

namespace App\Http\Livewire\User\Ticket;

use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Details extends Component
{

    use AuthorizesRequests;

    public $ticket_id;

    public function mount($ticket_id)
    {
        $this->ticket_id = $ticket_id;
    }


    public function render()
    {
        return view('livewire.user.ticket.details')
            ->layout('layouts.user.app');
    }

    public function getTicketProperty()
    {
        $ticket = Ticket::findOrFail($this->ticket_id);

        if ( $this->authorize('view', $ticket) ) {
            return $ticket;
        }
    }
}
