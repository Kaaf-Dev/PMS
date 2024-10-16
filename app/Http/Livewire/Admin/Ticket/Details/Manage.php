<?php

namespace App\Http\Livewire\Admin\Ticket\Details;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Livewire\Component;

class Manage extends Component
{
    use WithAlert;

    public $ticket;

    public function rules()
    {
        return [
            'ticket.visit_at' => 'nullable',
        ];
    }

    public function getListeners()
    {
        return [
            'ticket-updated' => '$refresh',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket = Ticket::findOrFail($ticket);;
    }


    public function render()
    {
        return view('livewire.admin.ticket.details.manage');
    }

    public function save()
    {
        $this->validate();
        $this->ticket->save();
        $this->emit('ticket-updated');
        $this->showSuccessAlert('تمت العملية بنجاح');
    }

    public function discard()
    {
        $this->ticket->refresh();
    }
}
