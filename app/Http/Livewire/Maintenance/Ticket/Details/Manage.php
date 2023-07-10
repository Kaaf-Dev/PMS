<?php

namespace App\Http\Livewire\Maintenance\Ticket\Details;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Manage extends Component
{

    use WithAlert;

    public $ticket;

    public function rules()
    {
        return [
            'ticket.status' => [
                'required',
                Rule::in($this->getStatusValueProperty())
            ],
        ];
    }

    public function mount($ticket)
    {
        $this->ticket = Ticket::findOrFail($ticket);;
    }

    public function render()
    {
        return view('livewire.maintenance.ticket.details.manage');
    }

    public function getStatusListProperty()
    {
        \Debugbar::info(Ticket::getStatusList());
        return Ticket::getStatusList();
    }

    public function getStatusValueProperty()
    {
        \Debugbar::info(Ticket::getStatusValues());
        return Ticket::getStatusValues();
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
