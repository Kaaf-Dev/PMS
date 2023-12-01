<?php

namespace App\Http\Livewire\Admin\Dashboard\Stats;

use App\Classes\Report\ReportService;
use Livewire\Component;

class MaintenanceOverview extends Component
{

    public $tickets_total = 0;
    public $tickets_finished_count = 0;
    public $tickets_finished_percent = 0;
    public $tickets_open_count = 0;
    public $tickets_open_percent = 0;
    public $tickets_under_process_count = 0;
    public $tickets_under_process_percent = 0;

    public $ready_to_load = false;

    public $type;

    public function getListeners()
    {
        return [
            'changeDashboardType',
        ];
    }

    public function changeDashboardType($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        if ($this->ready_to_load) $this->fetchData();
        return view('livewire.admin.dashboard.stats.maintenance-overview');
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function fetchData()
    {
        $report = ReportService::getMaintenanceOverview($this->type);
        $this->fill($report);
    }
}
