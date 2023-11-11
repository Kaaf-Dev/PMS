<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\LateRentReport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LateRent extends Component
{
    public $month_count = 3;

    public function rules()
    {
        return [
            'month_count' => 'nullable|numeric|min:1'
        ];
    }

    public function render()
    {
        return view('livewire.admin.report.form.late-rent');
    }

    public function export()
    {
        return Excel::download(new LateRentReport($this->month_count), 'late-rent.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-late-rent-modal');
    }
}
