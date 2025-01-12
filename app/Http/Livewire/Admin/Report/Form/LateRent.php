<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\LateRentReport;
use App\Models\Category;
use App\Models\Contract;
use App\Models\LawyerCase;
use App\Repository\printPDF;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LateRent extends Component
{
    public $month_count = 3;
    public $selected_category;
    public $lawyer_cases;

    public function rules()
    {
        return [
            'month_count' => 'nullable|numeric|min:1',
            'selected_category' => 'nullable',
            'lawyer_cases' => 'nullable',
        ];
    }

    public function render()
    {
        $categories = Category::all();
        $view_data = [
            'categories' => $categories
        ];

        return view('livewire.admin.report.form.late-rent', $view_data);
    }

    public function exportExcel()
    {
        return Excel::download(new LateRentReport($this->getReportData()), 'late-rent.xlsx');
    }

    public function exportPDF()
    {
        $data = $this->getReportData();

        $printPDF = new printPDF();
        $data = [
            'data' => $data,
            'selected_category' => $this->selected_category,
            'lawyer_cases' => $this->lawyer_cases,
            'month_count' => $this->month_count,
        ];
        $file = $printPDF->createPDF($data, 'pdf.late-rent-report', 'A4-L');

        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Late Rent Report.pdf"'
        ]);
    }

    public function getReportData()
    {
        $users = DB::table('users')
            ->select('users.name as user_name', 'users.phone as user_phone', 'users.id as user_id', 'contracts.id as contract_id')
            ->join('contracts', 'users.id', '=', 'contracts.user_id')
            ->join('invoices', 'contracts.id', '=', 'invoices.contract_id')
            ->leftJoin('receipts', function ($join) {
                $join->on('invoices.id', '=', 'receipts.invoice_id')
                    ->whereRaw('contracts.id = invoices.contract_id');
            })
            ->selectRaw('COUNT(CASE WHEN receipts.invoice_id IS NULL THEN invoices.id END) as unpaid_invoices')
            ->selectRaw('SUM(CASE WHEN receipts.invoice_id IS NULL THEN invoices.amount ELSE 0 END) as unpaid_invoices_sum')
            ->having('unpaid_invoices', '>=', $this->month_count)
            ->groupBy('users.id', 'users.name', 'users.phone', 'contracts.id')
            ->distinct('contracts.id')
            ->get();

        $report = [];
        $lawyer_cases = LawyerCase::pluck('contract_id');

        foreach ($users as $user) {
            $contracts = Contract::where('user_id', $user->user_id)->where('id', $user->contract_id)->get();
            if ($this->lawyer_cases == 1) {
                $contracts = $contracts->whereNotIn('id', $lawyer_cases);
            } elseif ($this->lawyer_cases == 2) {
                $contracts = $contracts->whereIn('id', $lawyer_cases);
            }

            foreach ($contracts as $contract) {
                $apartments = $contract->contractApartments;
                foreach ($apartments as $contractApartment) {
                    $category = $contractApartment->apartment->Property->category;
                    if ($category->id == $this->selected_category || $this->selected_category == null) {
                        $report[$user->user_id . $user->contract_id] = [
                            'user_name' => $user->user_name,
                            'user_phone' => $user->user_phone,
                            'property_no' => $contractApartment->apartment->Property->ky_no,
                            'property_name' => $contractApartment->apartment->Property->name,
                            'apartment_cost' => $contract->Cost,
                            'unpaid_invoices' => $user->unpaid_invoices,
                            'unpaid_invoices_sum' => (float) $user->unpaid_invoices_sum,
                        ];
                    }
                }
            }
        }

        // Sort the report by unpaid_invoices in descending order
        usort($report, function ($a, $b) {
            return $b['unpaid_invoices'] <=> $a['unpaid_invoices'];
        });

        return $report;
    }


    public function closeModal()
    {
        $this->emit('hide-admin-report-late-rent-modal');
    }
}
