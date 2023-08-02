<?php

namespace App\Http\Livewire\Admin\Ticket\Details;

use App\Models\MaintenanceCompany;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Traits\WithAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Info extends Component
{

    use WithAlert;

    public $ticket;

    public function rules()
    {
        return [
            'ticket.ticket_category_id' => 'nullable|exists:ticket_categories,id',
            'ticket.maintenance_company_id' => 'nullable|exists:maintenance_companies,id',
            'ticket.priority' => [
                'nullable',
                Rule::in($this->getPriorityValueProperty())
            ],
            'ticket.status' => [
                'required',
                Rule::in($this->getStatusValueProperty())
            ],
        ];
    }

    public function getMessages()
    {
        return [
            'exists' => 'يرجى اختيار قيمة صالحة',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket = Ticket::with([
            'contract.user',
        ])
            ->findOrFail($ticket);;
    }

    public function render()
    {
        return view('livewire.admin.ticket.details.info');
    }

    public function getMaintenanceCompaniesProperty()
    {
        return MaintenanceCompany::orderBy('name')->get();
    }

    public function getStatusListProperty()
    {
        return Ticket::getStatusList();
    }

    public function getStatusValueProperty()
    {
        return Ticket::getStatusValues();
    }

    public function getPriorityListProperty()
    {
        return Ticket::getPriorityList();
    }

    public function getPriorityValueProperty()
    {
        return Ticket::getPriorityValues();
    }

    public function getTicketCategoriesProperty()
    {
        return TicketCategory::all();
    }

    public function save()
    {
        $validated_data = $this->validate();

        if (!isset($validated_data['ticket']['maintenance_company_id']) or empty($validated_data['ticket']['maintenance_company_id'])) {
            $this->ticket->maintenance_company_id = null;
        }

        if (!isset($validated_data['ticket']['ticket_category_id']) or empty($validated_data['ticket']['ticket_category_id'])) {
            $this->ticket->ticket_category_id = null;
        }

        if (!isset($validated_data['ticket']['priority']) or empty($validated_data['ticket']['priority'])) {
            $this->ticket->priority = null;
        }

        if ($this->ticket->save()) {
            $this->emit('ticket-updated');
            $this->showSuccessAlert('تمت العملية بنجاح');
        } else {
            $this->showWarningAlert('حدث خطأ ما، يرجى المحاولة لاحقًا');
        }
    }

    public function discard()
    {
        $this->ticket->refresh();
    }
}
