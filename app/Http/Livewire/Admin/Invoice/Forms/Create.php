<?php

namespace App\Http\Livewire\Admin\Invoice\Forms;

use App\Classes\Payment\InvoiceService;
use App\Models\Contract;
use App\Models\Invoice;
use Livewire\Component;

class Create extends Component
{

    public $selected_contract;
    public $invoice;

    public function rules()
    {
        return [
            'selected_contract' => 'required',
            'invoice.no' => 'nullable',
            'invoice.contract_id' => 'required|exists:contracts,id',
            'invoice.date' => 'required',
            'invoice.due' => 'required',
            'invoice.amount' => 'required|numeric|min:0',
            'invoice.notes' => 'nullable',
        ];
    }

    public function getListeners()
    {
        return [
            'show-invoice-create-modal' => 'showModal',
        ];
    }

    public function render()
    {
        return view('livewire.admin.invoice.forms.create');
    }

    public function showModal($params)
    {
        $this->resetFields();

        $this->invoice = new Invoice();

        if (isset($params['contract_id'])) {
            $this->selectContract($params['contract_id']);
        }

        if (isset($params['date'])) {
            $this->invoice->date = $params['date'];
        }

        if (isset($params['due'])) {
            $this->invoice->due = $params['due'];
        }

        if (isset($params['amount'])) {
            $this->invoice->amount = $params['amount'];
        }

        if (isset($params['notes'])) {
            $this->invoice->notes = $params['notes'];
        }

        if (isset($params['type'])) {
            $this->invoice->type = $params['type'];
        }
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'selected_contract',
            'invoice',
        ]);
    }

    public function selectContract($contract_id)
    {
        $this->selected_contract = Contract::findOrFail($contract_id);
        $this->invoice->contract_id = $this->selected_contract->id;
        $this->invoice->no = $this->invoice->getNextNo();
    }

    public function save()
    {
        $invoice_service = new InvoiceService();
        $invoice_service->generateInvoice([
            'contract_id' => 1,
            'amount' => '99',
        ]);
        $this->emit('invoice_added');
    }
}
