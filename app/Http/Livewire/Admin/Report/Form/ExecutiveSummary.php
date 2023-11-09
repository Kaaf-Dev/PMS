<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\ExecutiveSummaryReport;
use App\Models\Category;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ExecutiveSummary extends Component
{

    public $selected_category;

    public function rules()
    {
        return [
            'selected_category' => 'nullable',
        ];
    }

    public function getListeners()
    {
        return [
            'show-admin-report-executive-summary-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.report.form.executive-summary');
    }

    public function resolveParams()
    {
        $this->reset();
    }

    public function getCategoriesProperty()
    {
        return Category::all();
    }

    public function export()
    {
        return Excel::download(new ExecutiveSummaryReport($this->selected_category), 'executive-summary.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-executive-summary-modal');
    }
}
