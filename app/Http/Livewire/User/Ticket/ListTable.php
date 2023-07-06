<?php

namespace App\Http\Livewire\User\Ticket;

use DebugBar\DebugBar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;
    protected $paginationTheme  = 'bootstrap';

    public $ready_to_load = false;

    public $search;

    public function getListeners()
    {
        return [
            'ticket-added' => '$refresh',
        ];
    }

    public function render()
    {
        $tickets = [];
        if ($this->ready_to_load) {
            $user = Auth::user();
            $search = $this->search;
            $tickets = $user->tickets()
                ->with('ticketCategory')
                ->where(function ($query) use ($search) {
                    $query->where('subject', 'like', '%'. $search .'%')
                    ->orWhere('description', 'like', '%'. $search .'%');
                })
                ->orderBy('status', 'asc')
                ->orderBy('updated_at', 'desc')
                ->paginate();
        }

        $view_data = [
            'tickets' => $tickets,
        ];

        return view('livewire.user.ticket.list-table', $view_data);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function load()
    {
        $this->ready_to_load = true;
    }
}
