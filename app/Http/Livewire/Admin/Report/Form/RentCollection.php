<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\RentCollectionReport;
use App\Models\Category;
use App\Models\Contract;
use App\Models\User;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RentCollection extends Component
{

    public $selected_user;

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

    public function getUsersProperty()
    {
        return User::all();
    }

    public function export()
    {
        return Excel::download(new RentCollectionReport([
            'user_id' => $this->selected_user
        ]), 'rent-collection.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-rent-collection-modal');
    }

}
