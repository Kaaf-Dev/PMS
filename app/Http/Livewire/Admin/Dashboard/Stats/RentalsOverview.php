<?php

namespace App\Http\Livewire\Admin\Dashboard\Stats;

use App\Classes\Report\ReportService;
use Livewire\Component;

class RentalsOverview extends Component
{
    public $rents_amount = 0;
    public $rents_percent = 0;

    public $available_amount = 0;
    public $available_percent = 0;

    public $apartment_rents_amount = 0;
    public $apartment_rents_percent = 0;

    public $apartment_available_amount = 0;
    public $apartment_available_percent = 0;

    public $store_rents_amount = 0;
    public $store_rents_percent = 0;

    public $store_available_amount = 0;
    public $store_available_percent = 0;

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
        return view('livewire.admin.dashboard.stats.rentals-overview');
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function fetchData()
    {
        $report = ReportService::getRentalsOverview($this->type);
        $properties = [];
        foreach ($report as $property => $value) {
            $properties[$property] = number_format($value);
        }
        $this->fill($properties);
    }
}
