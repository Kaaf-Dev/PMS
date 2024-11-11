<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\PropertiesOccupancyReport;
use App\Models\Category;
use App\Models\Property;
use App\Repository\printPDF;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class PropertiesOccupancy extends Component
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
            'show-admin-report-properties-occupancy-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.report.form.properties-occupancy');
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
        return Excel::download(new PropertiesOccupancyReport($this->getReportData()), 'properties-occupancy.xlsx');
    }

    public function exportPDF()
    {
        $data = [
            'data' => $this->getReportData(),
            'selected_category' => $this->selected_category
        ];

        $printPDF = new printPDF();
        $file = $printPDF->createPDF($data, 'pdf.properties-occupancy-report', 'A4-L');

        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="properties-occupancy-report.pdf"'
        ]);
    }

    public function getReportData()
    {
        $properties = Property::with([
            'apartments',
        ]);

        if ($this->selected_category > 0) {
            $properties = $properties->where('category_id', '=', $this->selected_category);
        }
        $properties = $properties->get();

        foreach ($properties as $property) {
            $report[$property->id] = [
                'property' => '',
                'rented_count' => 0,
                'rented_cost' => 0,
                'rented_percent' => 0,
                'available_count' => 0,
                'available_cost' => 0,
                'available_percent' => 0,
            ];

            $report[$property->id]['property'] = $property->name;

            foreach ($property->apartments as $apartment) {
                if ($apartment->isRented) {
                    $report[$property->id]['rented_count']++;
                    $report[$property->id]['rented_cost'] += $apartment->currentRentedCost;
                } else {
                    $report[$property->id]['available_count']++;
                    $report[$property->id]['available_cost'] += $apartment->cost;
                }
            }

            $report[$property->id]['total'] = $report[$property->id]['rented_count'] + $report[$property->id]['available_count'];

            if ($report[$property->id]['total'] > 0) {
                $report[$property->id]['rented_percent'] = round(($report[$property->id]['rented_count'] / $report[$property->id]['total']) * 100, 2);
                $report[$property->id]['available_percent'] = round(($report[$property->id]['available_count'] / $report[$property->id]['total']) * 100, 2);
            }
        }

        return collect($report);
    }


    public function closeModal()
    {
        $this->emit('hide-admin-report-properties-occupancy-modal');
    }
}
