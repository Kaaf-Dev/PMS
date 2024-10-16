<?php

namespace App\Http\Livewire\Admin\Receipt\Form;

use App\Models\Contract;
use App\Models\Discount;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Traits\WithAlert;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateForm extends Component
{
    use WithAlert;

    public $selected_contract;
    public $search_contract;
    public $contracts;
    public $payment_method;
    public $bank_name;
    public $cheque_number;
    public $receipt_date_as_invoice_due = true;

    public $selected_invoices;

    public function rules()
    {
        $rules =  [
            'selected_invoices.invoices.*.amount' => 'numeric',
            'selected_invoices.invoices.*.discount' => 'numeric',
            'selected_invoices.invoices.*.receipt_date_as_invoice_due' => 'nullable|boolean',
        ];

        foreach ($this->selected_invoices['invoices'] ?? [] as $key => $invoice) {

            $rules['selected_invoices.invoices.' . $key . '.payment_method'] = [
                Rule::requiredIf(function () use ($invoice) {
                    $this->updateSelectedInvoicesTotal();
                    return $invoice['amount'] > 0;
                }),
            ];

            $rules['selected_invoices.invoices.' . $key . '.bank_name'] = [
                Rule::requiredIf(function () use ($key){
                    return in_array($this->selected_invoices['invoices'][$key]['payment_method'], [
                        Receipt::PAYMENT_METHOD_CHEQUE,
                    ]);
                })
            ];

            $rules['selected_invoices.invoices.' . $key . '.cheque_number'] = [
                Rule::requiredIf(function () use ($key){
                    return $this->selected_invoices['invoices'][$key]['payment_method'] == Receipt::PAYMENT_METHOD_CHEQUE;
                })
            ];
        }

        return $rules;
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
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
    }

    public function updatedSelectedInvoices()
    {
        $this->updateSelectedInvoicesTotal();
    }


    public function resolveParams($params = [])
    {
        $this->resetFields();
        $this->fetchContracts();

        if (isset($params['contract_id'])) {
            $this->selectContract($params['contract_id']);
        }
        if (isset($params['invoice_id'])){
            $this->selectInvoice($params['invoice_id']);
        }
    }

    public function clearSearchContracts()
    {
        $this->fill([
            'search_contract' => null,
        ]);
        $this->fetchContracts();
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
        $this->receipt_date_as_invoice_due = true;
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
                'due' => $invoice->due,
                'discount' => 0,
                'payment_method' => null,
                'bank_name' => null,
                'cheque_number' => null,
                'receipt_date_as_invoice_due' => 1,
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

    public function getPaymentMethodsProperty()
    {
        return Receipt::getPaymentMethodList();
    }

    public function save()
    {
        $validated_data = $this->validate();
        if(isset($this->selected_invoices['invoices'])) {
            $date = Carbon::now();
            foreach ($this->selected_invoices['invoices'] as $invoice) {
                if (isset($invoice['receipt_date_as_invoice_due']) and $invoice['receipt_date_as_invoice_due']) {
                    $date = $invoice['due'];
                }

                if ($invoice['amount'] > 0) { // create receipt
                    $receipt = new Receipt();
                    $receipt->invoice_id = $invoice['id'];
                    $receipt->amount = $invoice['amount'];
                    $receipt->date = $date;

                    if (isset($invoice['payment_method'])) {
                        $receipt->payment_method = $invoice['payment_method'];
                    }

                    if (isset($invoice['bank_name'])) {
                        $receipt->bank_name = $invoice['bank_name'];
                    }

                    if (isset($invoice['cheque_number'])) {
                        $receipt->cheque_number = $invoice['cheque_number'];
                    }

                    $receipt->save();
                }

                if ($invoice['discount'] > 0) { // create discount
                    $discount = new Discount();
                    $discount->invoice_id = $invoice['id'];
                    $discount->amount = $invoice['discount'];
                    $discount->save();
                }
            }

            $this->emit('invoice_paid');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeModal();

        }
    }

    public function selectAll()
    {
        foreach($this->selected_contract->unPaidInvoices ?? [] as $invoice) {
            $this->selectInvoice($invoice->id);
        }
    }

    public function isSelected($invoice_id)
    {
        $is_selected = false;
        if (isset($this->selected_invoices['invoices']) and isset($this->selected_invoices['invoices'][$invoice_id])) {
            $is_selected = true;
        }
        return $is_selected;
    }

}
