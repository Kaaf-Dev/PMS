<?php

namespace App\Http\Livewire\Admin\MaintenanceCompany;

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
            'maintenance-company-added' => '$refresh',
            'maintenance-company-updated' => '$refresh',
        ];
    }

    public function render()
    {
        $maintenance_companies = ($this->ready_to_load)
            ? MaintenanceCompany::where('name', 'like', '%'. $this->search .'%')
                ->paginate()
            : [];
        $view_data = [
            'maintenance_companies' => $maintenance_companies,
        ];
        return view('livewire.admin.maintenance-company.list-table', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function showAddMaintenanceCompany()
    {
        $this->emit('show-maintenance-company-create-modal');
    }

    public function updateMaintenanceCompany($maintenance_company)
    {
        $this->emit('show-maintenance-company-update-modal', [
            'maintenance_company' => $maintenance_company,
        ]);
    }
}
