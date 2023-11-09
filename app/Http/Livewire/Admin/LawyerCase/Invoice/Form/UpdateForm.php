<?php

namespace App\Http\Livewire\Admin\LawyerCase\Invoice\Form;

use App\Models\LawyerInvoice;
use App\Traits\WithAlert;
use Livewire\Component;

class UpdateForm extends Component
{

    use WithAlert;

    public $lawyer_invoice;

    public function rules()
    {
        return [
            'lawyer_invoice.court_fees' => 'nullable|numeric',
            'lawyer_invoice.executor_fees' => 'nullable|numeric',
            'lawyer_invoice.attorneys_fees' => 'nullable|numeric',
            'lawyer_invoice.other' => 'nullable|numeric',
            'lawyer_invoice.amount' => 'nullable|numeric',
        ];
    }

    public function getListeners()
    {
        return [
            'show-admin-lawyer-case-invoice-update-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.lawyer-case.invoice.form.update-form');
    }

    public function resolveParams($params = [])
    {
        $this->resetFields();

        if (isset($params['invoice_id'])) {
            $this->lawyer_invoice = LawyerInvoice::findOrFail($params['invoice_id']);
            if (is_null($this->lawyer_invoice->amount)) {
                $this->lawyer_invoice->amount = $this->lawyer_invoice->calculateAmount();
            }
        }

    }

    public function save()
    {
        $validated_data = $this->validate();

        if ($this->lawyer_invoice->amount > 0) {
            $this->lawyer_invoice->status = LawyerInvoice::STATUS_CONFIRMED;
        } else {
            $this->lawyer_invoice->status = LawyerInvoice::STATUS_PENDING;
        }

        if ($this->lawyer_invoice->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->emit('lawyer-invoices-updated');
            $this->closeModal();
        } else {
            $this->showWarningAlert('عذرًا، حدث خطأ ما، يرجى المحاولة لاحقًا!');
        }

    }

    public function closeModal()
    {
        $this->resetFields();
        $this->emit('hide-admin-lawyer-case-invoice-update-modal');
    }

    public function resetFields()
    {
        $this->reset([
            'lawyer_invoice',
        ]);
    }
}
