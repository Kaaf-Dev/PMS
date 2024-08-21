<?php

namespace App\Http\Livewire\Maintenance\Ticket\Details;

use App\Events\CompanySetTicketTime;
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
        return view('livewire.maintenance.ticket.details.manage');
    }

    public function save()
    {
        $this->validate();
        if ($this->ticket->isDirty()){
            $this->ticket->status = Ticket::STATUS_UNDER_PROCESSING;
            if ($this->ticket->save()){
                event(new CompanySetTicketTime($this->ticket));
                $this->emit('ticket-updated');
                $this->showSuccessAlert('تمت العملية بنجاح');
            }
        }else{
            $this->showInfoAlert('لم يتم تحديد موعد الزيارة');

        }

    }

    public function discard()
    {
        $this->ticket->refresh();
    }

}
