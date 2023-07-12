<?php

namespace App\Http\Livewire\Admin\Ticket\Details;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddReply extends Component
{

    use WithAlert;

    public $ticket_id;
    public $reply;

    public function rules()
    {
        return [
            'reply' => 'required|string|max:2000',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
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
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.admin.ticket.details.add-reply');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }

    public function sendReply()
    {
        $validated_data = $this->validate();

        $reply = $this->ticket->ticketReplies()->create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'content' => $validated_data['reply'],
        ]);

        if ($reply) {
            $this->ticket->touch();
            $this->resetInputs();
            $this->emit('reply-added');
        } else {
            $this->showErrorAlert('لا يمكن إضافة الرد في الوقت الحالي');
        }
    }

    public function resetInputs()
    {
        $this->reset([
            'reply',
        ]);
    }
}
