<?php

namespace App\Http\Livewire\User\Ticket;

use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;
    protected $paginationTheme  = 'bootstrap';

    public $ready_to_load = false;

    public function render()
    {
        return view('livewire.user.ticket.list-table');
    }

    public function load()
    {
        $this->ready_to_load = true;
    }
}
