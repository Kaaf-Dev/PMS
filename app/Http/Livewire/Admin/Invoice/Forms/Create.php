<?php

namespace App\Http\Livewire\Admin\Invoice\Forms;

use App\Classes\Payment\InvoiceService;
use App\Models\Contract;
use App\Traits\WithAlert;
use Livewire\Component;

class Create extends Component
{

    use WithAlert;

    public $selected_contract;
    public $invoice;

    public $search_contract;

    public $contracts;

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

    public function updated($property)
    {
        if ($property == 'search_contract') {
            $this->fetchContracts();
        }
    }


    public function showModal($params)
    {
        $this->resetFields();
        $invoice_service = new InvoiceService();
        $this->invoice = $invoice_service->newInvoice();
        $this->fetchContracts();


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

    public function closeModal()
    {
        $this->emit('hide-invoice-create-modal');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'selected_contract',
            'invoice',
        ]);
    }

    public function fetchContracts()
    {
        $search_key = $this->search_contract;
        $this->contracts = Contract::where('id', 'like', '%'. $search_key .'%')
            ->orWhere(function($query) use ($search_key) {
                if ($search_key) {
                    $query->whereHas('user', function ($query) use ($search_key) {
                        $query->where('name', 'like', '%'. $search_key .'%');
                    })
                    ->orWhereHas('apartment', function ($query) use ($search_key) {
                        $query->where('name', 'like', '%'. $search_key .'%');
                    });
                }
            })
            ->limit(15)
            ->get();
    }

    public function selectContract($contract_id = 0)
    {
        if ($contract_id != 0) {
            $this->selected_contract = Contract::findOrFail($contract_id);
            $this->invoice->contract_id = $this->selected_contract->id;
            $this->invoice->no = $this->invoice->getNextNo();
        } else {
            $this->reset([
                'selected_contract',
                'search_contract',
            ]);
            $this->invoice->contract_id = null;
            $this->invoice->no = null;

        }
    }

    public function save()
    {
        $this->validate();
        $invoice_service = new InvoiceService();
        if ($invoice_service->saveInvoice($this->invoice)) {
            $this->emit('invoice_added');
            $this->closeModal();
            $this->showSuccessAlert('تمت العملية بنجاح');
        } else {
            $this->showWarningAlert('حدث خطأ ما');
        }

    }
}
