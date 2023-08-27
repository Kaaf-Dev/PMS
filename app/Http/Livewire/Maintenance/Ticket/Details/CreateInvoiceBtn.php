<?php

namespace App\Http\Livewire\Maintenance\Ticket\Details;

use App\Models\Ticket;
use Livewire\Component;

class CreateInvoiceBtn extends Component
{

    public $ticket_id;

    public function getListeners()
    {
        return [
            'invoice-added' => '$refresh',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.maintenance.ticket.details.create-invoice-btn');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }

    public function createInvoice()
    {
        $this->emit('show-maintenance-invoice-create-modal', [
            'ticket_id' => $this->ticket_id,
        ]);
    }

    public function showInvoice($maintenance_invoice_id)
    {
        $this->emit('show-maintenance-invoice-show-modal', [
            'maintenance_invoice_id' => $maintenance_invoice_id,
        ]);
    }
}
