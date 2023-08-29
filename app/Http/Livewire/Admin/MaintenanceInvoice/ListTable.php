<?php

namespace App\Http\Livewire\Admin\MaintenanceInvoice;

use App\Models\MaintenanceInvoice;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filters;

    public function getListeners()
    {
        return [
            'maintenance-invoices-filter' => 'updateFilters',
            'maintenance-invoice-updated' => '$refresh',
        ];
    }

    public function render()
    {
        $maintenance_invoices = $this->fetchMaintenanceInvoices();
        $view_data = [
            'maintenance_invoices' => $maintenance_invoices,
        ];
        return view('livewire.admin.maintenance-invoice.list-table', $view_data);
    }

    public function fetchMaintenanceInvoices()
    {
        $maintenance_invoices = MaintenanceInvoice::with([
            'maintenanceCompany',
            'ticket',
            'ticket.contract',
        ]);

        if (isset($this->filters['search'])) {
            $maintenance_invoices = $maintenance_invoices->search($this->filters['search']);
        }

        if (isset($this->filters['status'])) {
            $maintenance_invoices = $maintenance_invoices->where('status', '=', $this->filters['status']);
        }

        return $maintenance_invoices->paginate(15, ['*'], 'maintenanceInvoicePage');
    }

    public function updateFilters($filters)
    {
        $this->resetPage('maintenanceInvoicePage');
        $this->filters = $filters;
    }

    public function showMaintenanceInvoice($maintenance_invoice_id)
    {
        $this->emit('show-maintenance-invoice-manage-modal', [
            'maintenance_invoice_id' => $maintenance_invoice_id,
        ]);
    }
}
