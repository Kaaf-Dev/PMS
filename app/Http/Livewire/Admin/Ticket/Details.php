<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Ticket;
use Livewire\Component;

class Details extends Component
{

    public $ticket_id;

    public function mount($ticket_id, $notification_id = null)
    {
        $this->ticket_id = $ticket_id;

        //********** MarkReadNotifications ************
        if ($notification_id) {
            $notification = auth('admin')->user()->notifications()->where('id', $notification_id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.ticket.details')
            ->layout('layouts.admin.app');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }
}
