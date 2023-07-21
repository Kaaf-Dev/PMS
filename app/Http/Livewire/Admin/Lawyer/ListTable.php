<?php

namespace App\Http\Livewire\Admin\Lawyer;

use App\Models\Lawyer;
use App\Models\MaintenanceCompany;
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
            'lawyer-added' => '$refresh',
            'lawyer-updated' => '$refresh',
        ];
    }

    public function render()
    {
        $lawyers = ($this->ready_to_load)
            ? Lawyer::where('name', 'like', '%'. $this->search .'%')
                ->paginate()
            : [];
        $view_data = [
            'lawyers' => $lawyers,
        ];
        return view('livewire.admin.lawyer.list-table', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function showAddLawyer()
    {
        $this->emit('show-lawyer-create-modal');
    }

    public function updateLawyer($lawyer)
    {
        $this->emit('show-lawyer-update-modal', [
            'lawyer' => $lawyer,
        ]);
    }
}
