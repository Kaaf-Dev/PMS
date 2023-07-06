<?php

namespace App\Http\Livewire\User\Ticket\Details;

use App\Models\TicketReply;
use Livewire\Component;

class Replies extends Component
{

    public $ready_to_load = false;
    public $ticket_id;

    public function getListeners()
    {
        return [
            'reply-added' => '$refresh',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        $replies = ($this->ready_to_load)
            ? TicketReply::with([
                'admin',
                'user',
            ])
                ->where('ticket_id', '=', $this->ticket_id)
                ->orderBy('updated_at')
                ->get()
            : [];

        $view_data = [
            'replies' => $replies,
        ];
        return view('livewire.user.ticket.details.replies', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }
}
