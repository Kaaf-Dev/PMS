<?php

namespace App\Http\Livewire\Admin\Contract;

use App\Models\Contract;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ready_to_load = false;
    public $search;
    public $active_status;

    public function getListeners()
    {
        return [
            'contract_added' => '$refresh',
        ];
    }

    public function updated($property)
    {
        if ($property == 'search') {
            $this->resetPage();
        }

    }

    public function render()
    {
        $contracts = ($this->ready_to_load) ? $this->loadContracts() : [];
        $view_data = [
            'contracts' => $contracts,
        ];

        return view('livewire.admin.contract.list-table', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function loadContracts()
    {
        $now = Carbon::now();
        return Contract::when($this->active_status, function ($query) use ($now) {
            if ($this->active_status == 1) {
                $query->where('start_at', '<=', $now)
                    ->where('end_at', '>=', $now)
                    ->where('active', '=', 1);
            } elseif ($this->active_status == 2) {
                $query->where('active', '<>', 0)
                    ->where('end_at', '<=', $now)
                    ->orWhere('start_at', '>=', $now);
            } elseif ($this->active_status == 3) {
                $query->where('active', '=', 0);
            } elseif ($this->active_status == 4) {
                $query->whereHas('LawyerCase', function ($query) {
                    return $query;
                });
            }
        })->when($this->search, function ($query) {
            $query->whereHas('User', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->with([
                'apartments',
                'apartments.property',
                'user',
            ])
            ->orderBy('id', 'desc')
            ->paginate();
    }

    public function showAddContract()
    {
        $this->emit('show-contract-new-modal', []);
    }
}
