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
        return [
            'selected_invoices.invoices.*.amount' => 'numeric',
            'selected_invoices.invoices.*.discount' => 'numeric',
            'payment_method' => [
                Rule::requiredIf(function () {
                    $this->updateSelectedInvoicesTotal();
                    return $this->selected_invoices['total'] > 0;
                }),
            ],
            'bank_name' => [
                Rule::requiredIf(function () {
                    return $this->payment_method == Receipt::PAYMENT_METHOD_CHEQUE or $this->payment_method == Receipt::PAYMENT_METHOD_BANK;
                })
            ],
            'cheque_number' => [
                Rule::requiredIf(function () {
                    return $this->payment_method == Receipt::PAYMENT_METHOD_CHEQUE;
                })
            ],
            'receipt_date_as_invoice_due' => 'nullable|boolean',
        ];
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
            'payment_method',
            'bank_name',
            'cheque_number',
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
                'payment_method',
                'bank_name',
                'cheque_number',
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
                if (isset($validated_data['receipt_date_as_invoice_due']) and $validated_data['receipt_date_as_invoice_due']) {
                    $date = $invoice['due'];
                }

                if ($invoice['amount'] > 0) { // create receipt
                    $receipt = new Receipt();
                    $receipt->invoice_id = $invoice['id'];
                    $receipt->amount = $invoice['amount'];
                    $receipt->date = $date;

                    if (isset($validated_data['payment_method'])) {
                        $receipt->payment_method = $validated_data['payment_method'];
                    }

                    if (isset($validated_data['bank_name'])) {
                        $receipt->bank_name = $validated_data['bank_name'];
                    }

                    if (isset($validated_data['cheque_number'])) {
                        $receipt->cheque_number = $validated_data['cheque_number'];
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
