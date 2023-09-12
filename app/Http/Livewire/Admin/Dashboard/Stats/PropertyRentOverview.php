<?php

namespace App\Http\Livewire\Admin\Dashboard\Stats;

use App\Classes\Report\ReportService;
use Livewire\Component;

class PropertyRentOverview extends Component
{
    public $ready_to_load = false;

    public function render()
    {
        if ($this->ready_to_load) {
            $this->initChart();
        }
        return view('livewire.admin.dashboard.stats.property-rent-overview');
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function initChart()
    {
        $report = ReportService::getPropertyRentOverview();
        $this->emit('init-property-rent-overview-chart', [
            'series' => [
                [
                    'name' => 'الإيرادات',
                    'data' => $report['incomes_per_month'],
                ], [
                    'name' => 'المصروفات',
                    'data' => $report['expensive_per_month'],
                ]
            ],
        ]);
    }
}
