<?php

namespace App\Http\Livewire\Admin\LawyerCase\Invoice\Form;

use App\Models\LawyerInvoice;
use App\Traits\WithAlert;
use Livewire\Component;

class CreateForm extends Component
{

    use WithAlert;

    public $lawyer_case_id;

    public $court_fees;
    public $executor_fees;
    public $attorneys_fees;
    public $other;
    public $amount;

    public function rules()
    {
        return [
            'lawyer_case_id' => 'exists:lawyer_cases,id',
            'court_fees' => 'nullable|numeric',
            'executor_fees' => 'nullable|numeric',
            'attorneys_fees' => 'nullable|numeric',
            'other' => 'nullable|numeric',
            'amount' => 'nullable|numeric',
        ];
    }

    public function getMessages()
    {
        return [
            'exists' => 'يرجى التحقق من البيانات مرة أخرى!',
            'required' => 'هذا الحقل إجباري',
            'numeric' => 'يرجى إدخال بيانات صحيحة',
        ];
    }

    public function getListeners()
    {
        return [
            'show-admin-lawyer-case-invoice-create-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.lawyer-case.invoice.form.create-form');
    }

    public function resolveParams($params = [])
    {
        $this->resetFields();
        if (isset($params['lawyer_case_id'])) {
            $this->lawyer_case_id = $params['lawyer_case_id'];
        }
    }

    public function resetFields()
    {
        $this->reset([
            'court_fees',
            'executor_fees',
            'attorneys_fees',
            'other',
            'amount',
        ]);
    }

    public function save()
    {
        $validated_data = $this->validate();
        if (isset($validated_data['amount']) and $validated_data['amount'] > 0) {
            $validated_data['status'] = LawyerInvoice::STATUS_CONFIRMED;
        } else {
            $validated_data['status'] = LawyerInvoice::STATUS_PENDING;
        }
        $lawyer_invoice = LawyerInvoice::create($validated_data);
        if ($lawyer_invoice) {
             $this->showSuccessAlert('شكرًا لك، تمت العملية بنجاح');
             $this->emit('lawyer-invoices-added');
             $this->closeModal();
        } else {
            $this->showWarningAlert('عذرًا يرجى المحاولة مرة أخرى!');
        }
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->emit('hide-admin-lawyer-case-invoice-create-modal');
    }
}
