<?php

namespace App\Http\Livewire\Maintenance\Ticket;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Filter extends Component
{

    public $search;
    public $status;
    public $priority;
    public $ticket_categories;
    public $visit_in;

    public function rules()
    {
        return [
            'search' => 'nullable',
            'priority' => [
                'nullable',
                Rule::in(Ticket::getPriorityValues()),
            ],
            'status' => [
                'nullable',
                Rule::in(Ticket::getStatusValues()),
            ],
            'ticket_categories' => 'nullable|array',
            'ticket_categories.*' => 'nullable',
            'visit_in' => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.maintenance.ticket.filter');
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
