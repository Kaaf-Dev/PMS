<?php

namespace App\Http\Livewire\Lawyer\Contract;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filters;

    public function getListeners()
    {
        return [
            'contracts-filter' => 'updateFilters',
        ];
    }


    public function render()
    {
        $contracts = $this->fetchContracts();
        $view_data = [
            'contracts' => $contracts,
        ];
        return view('livewire.lawyer.contract.list-table', $view_data);
    }

    public function fetchContracts()
    {
        $this->resetPage();
        $auth = Auth::guard('lawyer')->user();
        $contracts = $auth->contracts();


        if (isset($this->filters['search'])) {
            $contracts = $contracts->search($this->filters['search']);
        }

        return $contracts->with([
            'user'
        ])
            ->orderBy('end_at', 'desc')
            ->orderBy('active', 'desc')
            ->paginate(15, ['*'], 'contractPage');

    }

    public function updateFilters($filters)
    {
        $this->filters = $filters;
    }

}
