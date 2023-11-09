<?php

namespace App\Http\Livewire\Maintenance\Ticket\Details;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class FinishTicket extends Component
{

    use AuthorizesRequests;
    use WithAlert;

    public $ticket;
    public $verification_code;

    public function rules()
    {
        return [
            'verification_code' => 'required',
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
            'show-maintenance-ticket-finish-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.maintenance.ticket.details.finish-ticket');
    }

    public function resolveParams($params)
    {
        if (isset($params['ticket_id'])) {
            $ticket = Ticket::findOrFail($params['ticket_id']);
            if ($this->authorize('finish', $ticket)) {
                $this->ticket = $ticket;
            }
        }
    }

    public function sendVerificationCode()
    {
        $this->ticket->generateVerificationCode();
        $this->ticket->save();
        $this->showSuccessAlert('تم إرسال رمز التأكيد إلى المستأجر!');
    }

    public function verifyFinish()
    {
        $this->showSuccessAlert('تمت العملية بنجاح');
    }

    public function finishTicket()
    {
        $validated_data = $this->validate();
        $verification_code = $validated_data['verification_code'];
        if ($this->ticket->verification_code == $verification_code) {
            $this->ticket->finish();
            $this->ticket->save();
            $this->emit('ticket-updated');
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->closeMe();
        } else {
            $this->addError('verification_code', 'رمز التأكيد غير صحيح، يرجى التأكد من الرمز والمحاولة مرة أخرى!');
        }
    }

    public function closeMe()
    {
        $this->reset([
            'verification_code',
            'ticket',
        ]);
        $this->resetErrorBag();
        $this->emit('hide-maintenance-ticket-finish-modal');
    }
}
