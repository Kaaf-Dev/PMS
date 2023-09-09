<?php

namespace App\Http\Livewire\Admin\Receipt\Form;

use App\Models\Contract;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Traits\WithAlert;
use Carbon\Carbon;
use Livewire\Component;

class CreateForm extends Component
{
    use WithAlert;

    public $selected_contract;
    public $search_contract;
    public $contracts;

    public $selected_invoices;

    public function rules()
    {
        return [
            'selected_invoices.invoices.*.amount' => 'integer',
        ];
    }

    public function getListeners()
    {
        return [
            'show-admin-receipt-create-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.receipt.form.create-form');
    }

    public function updated($property)
    {
        if ($property == 'search_contract') {
            $this->fetchContracts();
        }
        // todo:: update amount and total for selected invoices;
    }

    public function updatedSelectedInvoices()
    {
        $this->updateSelectedInvoicesTotal();
    }


    public function resolveParams($params)
    {
        $this->resetFields();
        $this->fetchContracts();

        if (isset($params['contract_id'])) {
            $this->selectContract($params['contract_id']);
        }
    }

    public function closeModal()
    {
        $this->emit('hide-admin-receipt-create-modal');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'selected_contract',
            'selected_invoices',
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
                        ->orWhereHas('apartments', function ($query) use ($search_key) {
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
        } else {
            $this->reset([
                'selected_contract',
            ]);
        }
    }

    public function selectInvoice($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        if ($invoice) {
            $this->selected_invoices['invoices'][$invoice->id] = [
                'id' => $invoice->id,
                'no' => $invoice->no,
                'amount' => $invoice->unPaidAmount,
                'origin_amount' => $invoice->unPaidAmount,
            ];
        }
        $this->updateSelectedInvoicesTotal();
    }

    public function removeInvoice($invoice_id)
    {
        if(isset($this->selected_invoices['invoices'])) if (isset($this->selected_invoices['invoices'][$invoice_id])) {
            unset($this->selected_invoices['invoices'][$invoice_id]);
            $this->updateSelectedInvoicesTotal();
        }
    }

    public function updateSelectedInvoicesTotal()
    {
        $total = 0;
        foreach ($this->selected_invoices['invoices'] ?? [] as $invoice){
            $total += $invoice['amount'];
        }
        $this->selected_invoices['total'] = $total;
    }

    public function save()
    {
        if(isset($this->selected_invoices['invoices'])) {
            $date = Carbon::now();
            foreach ($this->selected_invoices['invoices'] as $invoice) {
                $receipt = new Receipt();
                $receipt->invoice_id = $invoice['id'];
                $receipt->amount = $invoice['amount'];
                $receipt->date = $date;
                $receipt->save();
            }

            $this->emit('invoice_paid');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeModal();

        }
    }

}
