<?php

namespace App\Http\Livewire\Admin\MaintenanceInvoice;

use App\Models\MaintenanceCompany;
use App\Models\MaintenanceInvoice;
use App\Models\Ticket;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Filter extends Component
{

    public $search;
    public $status;
    public $maintenance_company_id;

    public function rules()
    {
        return [
            'search' => 'nullable',
            'maintenance_company_id' => 'nullable|exists:maintenance_companies,id',
            'status' => [
                'nullable',
                Rule::in(MaintenanceInvoice::getStatusValues()),
            ],
        ];
    }

    public function render()
    {
        return view('livewire.admin.maintenance-invoice.filter');
    }

    public function getMaintenanceCompaniesProperty()
    {
        return MaintenanceCompany::all();
    }

    public function getStatusListProperty()
    {
        return MaintenanceInvoice::getStatusList();
    }

    public function search()
    {
        $validated_data = $this->validate();
        $validated_data = array_filter($validated_data);
        $this->emit('maintenance-invoices-filter', $validated_data);
    }

    public function discard()
    {
        $this->reset([
            'search',
            'status',
        ]);
    }

}
