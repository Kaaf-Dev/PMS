<?php

namespace App\Http\Livewire\Maintenance\Ticket;

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
        return view('livewire.maintenance.ticket.details')
            ->layout('layouts.maintenance.app');
    }

    public function getTicketProperty()
    {
        $ticket = Ticket::withCount('maintenanceInvoices')
            ->findOrFail($this->ticket_id);

//        ddd($ticket);

        if ( $this->authorize('view', $ticket) ) {
            return $ticket;
        }
    }
}
