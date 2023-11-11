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
            'rent-collection' => 'show-admin-report-rent-collection-modal',
            'ticket-list' => 'show-admin-report-ticket-list-modal',
            'lawyer-cases' => 'show-admin-report-lawyer-cases-modal',
            'late-rent' => 'show-admin-report-late-rent-modal',

        ];

        if (isset($reports[$report])) {
            $this->emit($reports[$report]);
        }

    }
}
