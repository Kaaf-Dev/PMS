<?php

namespace App\Http\Livewire\User\Ticket\Form;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateForm extends Component
{

    use WithFileUploads;
    use WithAlert;

    public $ticket_categories;
    public $contracts;

    public $selected_contract;
    public $subject;
    public $description;

    public $attachments;
    public $attachment;

    public function rules()
    {
        return [
            'selected_contract' => 'required|exists:contracts,id',
            'subject' => 'required',
            'description' => 'required|max:5000',
            'attachments.*' => 'required|mimes:png,jpg,jpeg|max:1024',
        ];
    }

    public function getMessages()
    {
        return [
            'exists' => 'لا يوجد بيانات للحقل المحدد',
            'required' => 'هذا الحقل إجباري',
            'description.max' => 'لا يمكن تجاوز :max حرف',
            'attachment.max' => 'لا يمكن تجاوز :max MB',
            'mimes' => 'الصورة غير صالحة',
        ];
    }

    public function getListeners()
    {
        return [
            'show-user-ticket-create-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.user.ticket.form.create-form');
    }

    public function resolveParams($params = [])
    {
        $this->resetInputs();
        $this->resetErrorBag();
        $this->contracts = Auth::user()->contracts()
            ->with([
                'apartments.property',
            ])->get();
        if(isset($params['contract'])) {
            $this->selected_contract = $params;
        }

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
        $this->showSuccessAlert('تمت إضافة المرفق بنجاح!');
    }

    public function cancelAttachment($attachment)
    {
        if (isset($this->attachments[$attachment])) {
            unset($this->attachments[$attachment]);
        }
    }

    public function submit()
    {
        $validated_data = $this->validate();
        $ticket = new Ticket();
        $ticket->contract_id = $validated_data['selected_contract'];
        $ticket->subject = $validated_data['subject'];
        $ticket->description = $validated_data['description'];
        if ($ticket->save()) {
            $attachments = [];
            foreach ($validated_data['attachments'] ?? [] as $attachment) {
                $attachments[] = [
                    'path' =>  $attachment->store(md5($ticket->id), 'ticket_attachments'),
                    'file_name' => $attachment->getClientOriginalName(),
                ];
            }
            $ticket_attachments = $ticket->ticketAttachments()->createMany($attachments);
            \Debugbar::info($attachments, $ticket_attachments);
            \Debugbar::info();
            $this->showSuccessAlert('تمت إضافة الطلب بنجاح');
            $this->hideMe();
            $this->emit('ticket-added');
            $this->resetInputs();
        } else {
            $this->showErrorAlert('لا يمكن تسجيل الطلب في الوقت الحالي، يرجى المحاولة لاحقًا!');
        }
    }

    public function hideMe()
    {
        $this->emit('hide-user-ticket-create-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'selected_contract',
            'subject',
            'description',
            'attachment',
            'attachments',
        ]);
    }
}
