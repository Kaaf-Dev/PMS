<?php

namespace App\Http\Livewire\User\Ticket\Form;

use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateForm extends Component
{

    use WithAlert;

    public $ticket_categories;
    public $contracts;

    public $selected_contract;
    public $selected_ticket_category;
    public $subject;
    public $description;

    public function rules()
    {
        return [
            'selected_contract' => 'required|exists:contracts,id',
            'selected_ticket_category' => 'required|exists:ticket_categories,id',
            'subject' => 'required',
            'description' => 'required|max:5000',
        ];
    }

    public function getMessages()
    {
        return [
            'exists' => 'لا يوجد بيانات للحقل المحدد',
            'required' => 'هذا الحقل إجباري',
            'max' => 'لا يمكن تجاوز :max حرف',
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
        $this->contracts = Auth::user()->contracts()
            ->with([
                'apartments.property',
            ])->get();
        $this->ticket_categories = TicketCategory::all();

        if(isset($params['contract'])) {
            $this->selected_contract = $params;
        }

    }

    public function submit()
    {
        $validated_data = $this->validate();
        \Debugbar::info($validated_data);
        $ticket = new Ticket();
        $ticket->contract_id = $validated_data['selected_contract'];
        $ticket->ticket_category_id = $validated_data['selected_ticket_category'];
        $ticket->subject = $validated_data['subject'];
        $ticket->description = $validated_data['description'];
        if ($ticket->save()) {
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
            'selected_ticket_category',
            'subject',
            'description',
        ]);
    }
}
