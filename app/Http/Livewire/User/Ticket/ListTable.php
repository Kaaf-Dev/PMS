<?php

namespace App\Http\Livewire\User\Ticket;

use App\Models\Ticket;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;
    protected $paginationTheme  = 'bootstrap';

    public $ready_to_load = false;

    public $contract_id;
    public $search;
    public $status;

    public function getListeners()
    {
        return [
            'ticket-added' => '$refresh',
        ];
    }

    public function mount($contract_id = null)
    {
        if ($contract_id) {
            $this->contract_id = $contract_id;
        }
    }

    public function render()
    {
        $tickets = [];
        if ($this->ready_to_load) {
            $user = Auth::user();
            $search = $this->search;
            $contract_id = $this->contract_id;
            $status = $this->status;
            $tickets = $user->tickets()
                ->with('ticketCategory')
                ->where(function ($query) use ($contract_id) {
                    if ($contract_id) {
                        $query->where('contract_id', '=', $contract_id);
                    }
                })
                ->where(function ($query) use ($status) {
                    if ($status) {
                        $query->where('status', '=', $status);
                    }
                })
                ->where(function ($query) use ($search) {
                    $query->where('subject', 'like', '%'. $search .'%')
                    ->orWhere('description', 'like', '%'. $search .'%')
                    ->orWhere('no', 'like', '%'. $search .'%');
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

    public function getContractsProperty()
    {
        return Auth::user()->contracts;
    }

    public function getStatusListProperty()
    {
        \Debugbar::info(Ticket::getStatusList());
        return Ticket::getStatusList();
    }

    public function load()
    {
        $this->ready_to_load = true;
    }
}
