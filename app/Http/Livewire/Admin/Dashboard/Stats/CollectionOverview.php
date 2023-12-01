<?php

namespace App\Http\Livewire\Admin\Dashboard\Stats;

use App\Classes\Report\ReportService;
use Livewire\Component;

class CollectionOverview extends Component
{

    public $invoices_amount = 0;
    public $collected_amount = 0;
    public $discount_amount = 0;
    public $coming_amount = 0;

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
        return view('livewire.admin.dashboard.stats.collection-overview');
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function fetchData()
    {
        $report = ReportService::getCollectionOverview($this->type);
        $properties = [];
        foreach ($report as $property => $value) {
            $properties[$property] = number_format($value);
        }
        $this->fill($properties);
    }

}
