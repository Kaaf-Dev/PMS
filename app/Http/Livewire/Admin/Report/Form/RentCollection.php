<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\RentCollectionReport;
use App\Models\Category;
use App\Models\Contract;
use App\Models\User;
use App\Repository\printPDF;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RentCollection extends Component
{

    public $selected_user;
    public $contract_id;
    public $user_id;

    public function rules()
    {
        return [
            'selected_user' => 'nullable',
        ];
    }

    public function getListeners()
    {
        return [
            'show-admin-report-rent-collection-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.report.form.rent-collection');
    }

    public function resolveParams()
    {
        $this->reset();
    }

    public function getUsersProperty()
    {
        return User::all();
    }

    public function exportExcel()
    {
        return Excel::download(new RentCollectionReport($this->getReportData()), 'rent-collection.xlsx');
    }

    public function exportPDF()
    {
        $data = [
            'data' => $this->getReportData(), // Correcting this to use an associative array
            'selected_user' => $this->selected_user,
        ];

        $printPDF = new printPDF();
        $file = $printPDF->createPDF($data, 'pdf.rent-collection-report', 'A4-L');

        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="rent-collection-report.pdf"'
        ]);
    }


    public function getReportData()
    {
        $contracts = Contract::query();

        if ($this->contract_id > 0) {
            $contracts = $contracts->where('contract_id', '=', $this->contract_id);
        }

        if ($this->selected_user > 0) {
            $contracts = $contracts->where('user_id', '=', $this->selected_user);
        }

        $contracts = $contracts->with([
            'user',
            'invoices',
        ])->get();

        $report = [];
        foreach ($contracts as $contract) {
            $report[$contract->id] = [
                'contract_id' => $contract->id,
                'user' => optional($contract->user)->name ?? '-',
                'total' => $contract->invoices_total ?? 0,
                'paid' => $contract->receipts_total ?? 0,
                'collect_percent' => ($contract->invoices_total > 0)
                    ? number_format(round(($contract->receipts_total / $contract->invoices_total) * 100), '2') . '%'
                    : 0,
            ];
        }

        return $report;
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-rent-collection-modal');
    }

}
