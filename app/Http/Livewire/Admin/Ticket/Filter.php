<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\MaintenanceCompany;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Filter extends Component
{

    public $search;
    public $status;
    public $priority;
    public $user_id;
    public $maintenance_company_id;
    public $ticket_categories;
    public $visit_in;

    public function rules()
    {
        return [
            'search' => 'nullable',
            'user_id' => 'nullable|exists:users,id',
            'maintenance_company_id' => 'nullable|exists:maintenance_companies,id',
            'status' => [
                'nullable',
                Rule::in(Ticket::getStatusValues()),
            ],
            'priority' => [
                'nullable',
                Rule::in(Ticket::getPriorityValues()),
            ],
            'ticket_categories' => 'nullable|array',
            'ticket_categories.*' => 'nullable',
            'visit_in' => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.admin.ticket.filter');
    }

    public function getUsersProperty()
    {
        return User::orderBy('name')->get();
    }

    public function getMaintenanceCompaniesProperty()
    {
        return MaintenanceCompany::all();
    }

    public function getStatusListProperty()
    {
        return Ticket::getStatusList();
    }

    public function getPriorityListProperty()
    {
        return Ticket::getPriorityList();
    }

    public function getTicketCategoriesProperty()
    {
        return TicketCategory::all();
    }

    public function search()
    {
        $validated_data = $this->validate();
        $validated_data['ticket_categories'] = array_filter($validated_data['ticket_categories'] ?? []);
        $validated_data = array_filter($validated_data);
        $this->emit('tickets-filter', $validated_data);
    }

    public function discard()
    {
        $this->reset([
            'search',
            'status',
            'ticket_categories',
            'visit_in',
        ]);
    }

}
