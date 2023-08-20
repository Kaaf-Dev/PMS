<?php

namespace App\Http\Livewire\User\Ticket\Details;

use App\Models\Ticket;
use Livewire\Component;

class Rating extends Component
{

    public $ticket_id;
    public $show_verification_code = false;

    public function rules()
    {
        return [
            'rate_stars' => 'required|integer',
            'rate_notes' => 'nullable',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.user.ticket.details.rating');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }

    public function submit()
    {
        $validated_data = $this->validate();
        \Debugbar::info($validated_data);
    }
}
