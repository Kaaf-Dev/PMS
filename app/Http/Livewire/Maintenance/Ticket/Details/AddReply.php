<?php

namespace App\Http\Livewire\Maintenance\Ticket\Details;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddReply extends Component
{

    use AuthorizesRequests;
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
        return view('livewire.maintenance.ticket.details.add-reply');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }

    public function sendReply()
    {
        $validated_data = $this->validate();
        $this->authorize('reply', $this->ticket);

        $reply = $this->ticket->ticketReplies()->create([
            'maintenance_company_id' => Auth::guard('maintenance_company')->user()->id,
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
