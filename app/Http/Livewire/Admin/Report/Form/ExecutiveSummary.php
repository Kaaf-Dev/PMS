<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\ExecutiveSummaryReport;
use App\Models\Category;
use App\Repository\printPDF;
use Illuminate\Support\Facades\DB;
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

    public function exportExcel()
    {
        return Excel::download(new ExecutiveSummaryReport($this->selected_category), 'executive-summary.xlsx');
    }

    public function exportPDF()
    {
        // Get the data for the PDF

        $data = ['data' => $this->export(), 'selected_category' => $this->selected_category];
        // Generate the PDF file using printPDF
        $printPDF = new printPDF();
        $file = $printPDF->createPdf($data, 'pdf.executive-summary', 'A4-L');

        // Return the PDF as a downloadable response
        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="executive-summary.pdf"',
        ]);
    }

    public function export()
    {
        // Query to get properties
        $properties = DB::table('properties')

            ->select('properties.name as property_name', 'properties.ky_no as property_ky_no',
                'properties.market_value as property_market_value', 'properties.place as property_place',
                'properties.block as property_block', 'properties.road as property_road')
            ->selectRaw('SUM(IF(apartments.type = 1, 1, 0)) as apartment_with_type_1_count')
            ->selectRaw('SUM(IF(apartments.type = 2, 1, 0)) as apartment_with_type_2_count')
            ->selectRaw('SUM(IF(apartments.type = 3, 1, 0)) as apartment_with_type_3_count')
            ->selectRaw('SUM(1) as sum_of_apartments')
            ->selectRaw('SUM(IF(contracts.active = 1, contract_apartment.cost, 0)) as total_amount_for_active_contract')
            ->leftJoin('apartments', 'properties.id', '=', 'apartments.property_id')
            ->leftJoin('contract_apartment', 'apartments.id', '=', 'contract_apartment.apartment_id')
            ->leftJoin('contracts', 'contract_apartment.contract_id', '=', 'contracts.id');

        if ($this->selected_category > 0) {

            $properties = $properties->where('category_id', '=', $this->selected_category);
        }

        $properties = $properties->groupBy('properties.name', 'properties.ky_no', 'properties.market_value',
            'properties.place', 'properties.block', 'properties.road')
            ->get()
            ->map(function ($item) {
                return [
                    'property_name' => mb_convert_encoding($item->property_name, 'UTF-8'),
                    'property_ky_no' => mb_convert_encoding($item->property_ky_no, 'UTF-8'),
                    'market_value' => mb_convert_encoding($item->property_market_value, 'UTF-8'),
                    'apartment_with_type_1_count' => $item->apartment_with_type_1_count,
                    'apartment_with_type_2_count' => $item->apartment_with_type_2_count,
                    'sum_of_apartments' => $item->sum_of_apartments,
                    'total_amount_for_active_contract' => mb_convert_encoding($item->total_amount_for_active_contract, 'UTF-8'),
                    'property_place' => mb_convert_encoding($item->property_place, 'UTF-8'),
                    'property_block' => mb_convert_encoding($item->property_block, 'UTF-8'),
                    'property_road' => mb_convert_encoding($item->property_road, 'UTF-8'),
                ];
            });

        return $properties;
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-executive-summary-modal');
    }
}
