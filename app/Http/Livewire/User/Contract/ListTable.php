<?php

namespace App\Http\Livewire\User\Contract;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;
    protected $paginationTheme  = 'bootstrap';

    public $ready_to_load = false;

    public function render()
    {
        $contracts = ($this->ready_to_load)
            ? Auth::user()->contracts()->paginate()
            : null;

        return view('livewire.user.contract.list-table', [
            'contracts' => $contracts,
        ]);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }
}
