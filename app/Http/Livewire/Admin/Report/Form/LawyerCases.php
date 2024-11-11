<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\LawyerCasesReport;
use App\Models\Lawyer;
use App\Models\LawyerCase;
use App\Repository\printPDF;
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

    public function exportExcel()
    {
        return Excel::download(new LawyerCasesReport($this->getReportData()), 'lawyer-cases.xlsx');
    }

    public function exportPDF()
    {
        $data = [
            'data' => $this->getReportData(),  // Correctly assign report data to the 'data' key
            'selected_lawyer' => $this->selected_lawyer,
        ];

        $printPDF = new printPDF();
        $file = $printPDF->createPDF($data, 'pdf.lawyer-cases-report', 'A4-L');

        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="lawyer-cases-report.pdf"'
        ]);
    }

    public function getReportData()
    {
        $lawyer_cases = LawyerCase::query();

        if ($this->selected_lawyer > 0) {
            $lawyer_cases = $lawyer_cases->where('lawyer_id', '=', $this->selected_lawyer);
        }

        $lawyer_cases = $lawyer_cases
            ->with([
                'lawyer',
                'contract',
                'court',
                'status',
            ])
            ->get();

        $report = [];

        foreach ($lawyer_cases as $lawyer_case) {
            $report[$lawyer_case->id] = [
                'id' => $lawyer_case->id,
                'collected_amount' => $lawyer_case->collected_amount,
                'amount' => $lawyer_case->amount,
                'status' => optional($lawyer_case->status)->title,
                'first_side' => $lawyer_case->first_side,
                'second_side' => $lawyer_case->second_side,
                'case_no' => $lawyer_case->case_no,
            ];
        }


        return $report;
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-lawyer-cases-modal');
    }
}
