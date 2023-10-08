<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\LawyerCasesReport;
use App\Models\Lawyer;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LawyerCases extends Component
{

    public $selected_lawyer;

    public function rules()
    {
        return [
            'selected_lawyer' => 'nullable',
        ];
    }

    public function getListeners()
    {
        return [
            'show-admin-report-lawyer-cases-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.report.form.lawyer-cases');
    }

    public function resolveParams()
    {
        $this->reset();
    }

    public function getLawyersProperty()
    {
        return Lawyer::all();
    }

    public function export()
    {
        return Excel::download(new LawyerCasesReport($this->selected_lawyer), 'lawyer-cases.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-lawyer-cases-modal');
    }
}
