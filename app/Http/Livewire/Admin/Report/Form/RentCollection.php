<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\RentCollectionReport;
use App\Models\Category;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RentCollection extends Component
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

    public function getCategoriesProperty()
    {
        return Category::all();
    }

    public function export()
    {
        return Excel::download(new RentCollectionReport($this->selected_category), 'rent-collection.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-rent-collection-modal');
    }

}
