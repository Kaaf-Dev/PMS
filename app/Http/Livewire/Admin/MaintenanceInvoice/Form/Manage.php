<?php

namespace App\Http\Livewire\Admin\MaintenanceInvoice\Form;

use App\Models\MaintenanceInvoice;
use App\Traits\WithAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Manage extends Component
{

    use WithAlert;

    public $maintenance_invoice;

    public function rules()
    {
        return [
            'maintenance_invoice.amount' => 'required|numeric',
            'maintenance_invoice.status' => [
                'required',
                Rule::in(MaintenanceInvoice::getStatusValues()),
            ],
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'in' => 'يرجى اختيار قيمة صالحة',
        ];
    }

    public function getListeners()
    {
        return [
            'show-maintenance-invoice-manage-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.maintenance-invoice.form.manage');
    }

    public function resolveParams($params = [])
    {
        if (isset($params['maintenance_invoice_id'])) {
            $this->maintenance_invoice = MaintenanceInvoice::findOrFail($params['maintenance_invoice_id']);
        }
    }

    public function getStatusListProperty()
    {
        return MaintenanceInvoice::getStatusList();
    }

    public function submit()
    {
        $validated_data = $this->validate();
        if ($this->maintenance_invoice->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->emit('maintenance-invoice-updated');
        } else {
            $this->showWarningAlert('عذرًا، يرجى المحاولة مرة أخرى!');
        }
    }

    public function hideMe()
    {
        $this->resetInputs();
        $this->emit('hide-maintenance-invoice-manage-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'maintenance_invoice',
        ]);
    }
}
