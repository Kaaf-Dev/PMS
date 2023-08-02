<?php

namespace App\Http\Livewire\Maintenance\Ticket;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filters;
    public $order_by;
    public $order_as;

    public function getListeners()
    {
        return [
            'tickets-filter' => 'updateFilters',
        ];
    }

    public function render()
    {
        $tickets = $this->fetchTickets();
        $view_data = [
            'tickets' => $tickets,
        ];
        return view('livewire.maintenance.ticket.list-table', $view_data);
    }

    public function orderBy($property)
    {
        if (in_array($property, [
            'contract_id',
            'updated_at',
            'visit_at',
            'status',
        ])) {
            if ($this->order_by == $property) { // swap order by
                if ($this->order_as == 'asc') {
                    $this->order_as = 'desc';
                } else {
                    $this->order_as = 'asc';
                }
            } else {
                $this->order_by = $property;
                $this->order_as = 'asc';
            }
        }
    }

    public function fetchTickets()
    {
        $this->resetPage();
        $auth = Auth::guard('maintenance_company')->user();
        $tickets = $auth->tickets();

        if (isset($this->filters['priority'])) {
            $tickets = $tickets->where('priority', '=', $this->filters['priority']);
        }

        if (isset($this->filters['status'])) {
            $tickets = $tickets->where('status', '=', $this->filters['status']);
        }

        if (isset($this->filters['ticket_categories'])) {
            $tickets = $tickets->whereIn('ticket_category_id', $this->filters['ticket_categories']);
        }

        if (isset($this->filters['visit_in'])) {
            $tickets = $tickets->visitIn($this->filters['visit_in']);
        }

        if (isset($this->filters['search'])) {
            $tickets = $tickets->search($this->filters['search']);
        }

        if ($this->order_by) {
            $tickets = $tickets->orderBy($this->order_by, $this->order_as);
        }

        return $tickets->with([
            'contract.user',
            'ticketCategory',
        ])->paginate(15, ['*'], 'ticketsPage');

    }

    public function updateFilters($filters)
    {
        $this->filters = $filters;
    }
}
