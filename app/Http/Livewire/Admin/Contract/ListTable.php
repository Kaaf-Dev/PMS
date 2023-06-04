<?php

namespace App\Http\Livewire\Admin\Contract;

use App\Models\Contract;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ready_to_load = false;
    public $search;

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
        return Contract::orderBy('id', 'desc')
            ->paginate();
    }

    public function showAddContract()
    {
        $this->emit('show-contract-new-modal', []);
    }
}
