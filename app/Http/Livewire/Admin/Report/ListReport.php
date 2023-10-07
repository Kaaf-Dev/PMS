<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;

class ListReport extends Component
{
    public function render()
    {
        return view('livewire.admin.report.list-report');
    }

    public function showReport($report)
    {
        $reports = [
            'executive-summary' => 'show-admin-report-executive-summary-modal',
            'properties-occupancy' => 'show-admin-report-properties-occupancy-modal',
        ];

        if (isset($reports[$report])) {
            $this->emit($reports[$report]);
        }

    }
}
