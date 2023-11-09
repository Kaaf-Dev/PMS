<?php

namespace App\Http\Livewire\Maintenance\Invoice\Form;

use App\Models\MaintenanceInvoice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ShowDetails extends Component
{
    use AuthorizesRequests;

    public $maintenance_invoice_id;

    public function getListeners()
    {
        return [
            'show-maintenance-invoice-show-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.maintenance.invoice.form.show-details');
    }

    public function getMaintenanceInvoiceProperty()
    {
        $maintenance_invoice = MaintenanceInvoice::find($this->maintenance_invoice_id);
        if ($maintenance_invoice) {
            $this->authorize('view', $maintenance_invoice);
        }
        return $maintenance_invoice;
    }

    public function resolveParams($params = [])
    {
        if (isset($params['maintenance_invoice_id'])) {
            $this->maintenance_invoice_id = $params['maintenance_invoice_id'];
        }
    }

}
