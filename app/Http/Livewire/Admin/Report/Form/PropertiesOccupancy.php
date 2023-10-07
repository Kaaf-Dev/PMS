<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\PropertiesOccupancyReport;
use App\Models\Category;
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

    public function export()
    {
        return Excel::download(new PropertiesOccupancyReport($this->selected_category), 'executive-summary.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-properties-occupancy-modal');
    }
}
