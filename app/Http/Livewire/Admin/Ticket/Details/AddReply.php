<?php

namespace App\Http\Livewire\Admin\Ticket\Details;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddReply extends Component
{

    use WithFileUploads;
    use WithAlert;

    public $ticket_id;
    public $reply;

    public $attachments;
    public $attachment;

    public function rules()
    {
        return [
            'reply' => 'required|string|max:2000',
            'attachments.*' => 'required|mimes:png,jpg,jpeg|max:1024',
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

    public function updatedAttachment()
    {
        $this->validate([
            'attachment' => 'required|mimes:png,jpg,jpeg|max:10240', // 1MB Max
        ]);
        $this->attachments[md5(time())] = $this->attachment;
        $this->reset([
            'attachment',
        ]);
    }

    public function cancelAttachment($attachment)
    {
        if (isset($this->attachments[$attachment])) {
            unset($this->attachments[$attachment]);
        }
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
            $attachments = [];
            foreach ($validated_data['attachments'] ?? [] as $attachment) {
                $attachments[] = [
                    'path' =>  $attachment->store('reply-' . md5($reply->id), 'ticket_attachments'),
                    'file_name' => $attachment->getClientOriginalName(),
                ];
            }
            $reply->attachments()->createMany($attachments);
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
            'attachments',
            'attachment',
        ]);
    }
}
