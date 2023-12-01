<?php

namespace App\Http\Livewire\Admin\Dashboard\Stats;

use App\Classes\Report\ReportService;
use Livewire\Component;

class OccupancyOverview extends Component
{
    public $ready_to_load = false;

    public $rented_count = 0;
    public $rented_percent = 0;
    public $available_count = 0;
    public $available_percent = 0;

    public $apartment_count = 0;
    public $apartment_percent = 0;
    public $apartment_rented_count = 0;
    public $apartment_rented_percent = 0;
    public $apartment_available_count = 0;
    public $apartment_available_percent = 0;

    public $store_count = 0;
    public $store_percent = 0;
    public $store_rented_count = 0;
    public $store_rented_percent = 0;
    public $store_available_count = 0;
    public $store_available_percent = 0;

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
        return view('livewire.admin.dashboard.stats.occupancy-overview');
    }

    public function fetchData()
    {
        $occupancy = ReportService::getOccupancyOverview($this->type);
        $this->fill($occupancy);
        \Debugbar::info('occupancy: ');
        \Debugbar::info($occupancy);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }
}
