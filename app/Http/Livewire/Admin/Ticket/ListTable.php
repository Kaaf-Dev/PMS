<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filters;
    public $order_by;
    public $order_as = 'asc';

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
        return view('livewire.admin.ticket.list-table', $view_data);
    }

    public function orderBy($property)
    {
        if (in_array($property, [
            'contract_id',
            'maintenance_company_id',
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
        $order_by = $this->order_by;
        $order_as = $this->order_as;

        $tickets = Ticket::with([
            'contract.user',
            'ticketCategory',
            'maintenanceCompany',
        ]);

        if (isset($this->filters['search'])) {
            $tickets = $tickets->search($this->filters['search']);
        }

        if (isset($this->filters['status'])) {
            $tickets = $tickets->where('status', '=', $this->filters['status']);
        }

        if (isset( $this->filters['user_id'] )) {
            $tickets = $tickets->user($this->filters['user_id']);
        }

        if (isset($this->filters['ticket_categories'])) {
            $tickets = $tickets->whereIn('ticket_category_id', $this->filters['ticket_categories']);
        }

        if (isset($this->filters['visit_in'])) {
            $tickets = $tickets->visitIn($this->filters['visit_in']);
        }

        if ($order_by) {
            $tickets = $tickets->orderBy($order_by, $order_as);
        }

        return $tickets->paginate(15, ['*'], 'ticketsPage');

    }

    public function updateFilters($filters)
    {
        $this->resetPage('ticketsPage');
        $this->filters = $filters;
    }

}
