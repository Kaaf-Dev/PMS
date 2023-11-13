<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\LateRentReport;
use App\Models\Category;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LateRent extends Component
{
    public $month_count = 3;
    public $selected_category;

    public function rules()
    {
        return [
            'month_count' => 'nullable|numeric|min:1',
            'selected_category' => 'nullable',
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

    public function export()
    {
        $data = [
            'month_count' => $this->month_count,
            'selected_category' => $this->selected_category
        ];
        return Excel::download(new LateRentReport($data), 'late-rent.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-late-rent-modal');
    }
}
