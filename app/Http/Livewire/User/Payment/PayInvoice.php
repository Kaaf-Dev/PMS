<?php

namespace App\Http\Livewire\User\Payment;

use App\Models\Invoice;
use App\Repository\paymentGateway;
use App\Repository\saveCardToken;
use App\Traits\WithAlert;
use Livewire\Component;

class PayInvoice extends Component
{

    use WithAlert;

    public $invoice_id;

    public $card_name, $card_number, $card_month_exp, $card_year_exp,
        $card_cvv;

    public function rules()
    {
        return [
            'invoice_id' => 'required|exists:invoices,id',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
        ];
    }

    public function getListeners()
    {
        return [
            'show-user-pay-invoice-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        $currentYear = date('Y');
        $expiryYears = collect(range(0, 10))
            ->map(function ($i) use ($currentYear) {
                $year = $currentYear + $i;
                $label = substr($year, -2);
                return ['label' => $label, 'value' => $year];
            })
            ->toArray();

        $view_data = [
            'expiryYears' => $expiryYears,
        ];

        return view('livewire.user.payment.pay-invoice', $view_data);
    }

    public function resolveParams($params)
    {
        $this->reset();

        if (isset($params['invoice_id'])) {
            $this->invoice_id = $params['invoice_id'];
        }
    }

    public function getInvoiceProperty()
    {
        return Invoice::find($this->invoice_id);
    }

    public function pay()
    {
        $validated_data = $this->validate();

        $card_data = [
            'user_id' => auth()->user()->id,
            'card_name' => $this->card_name,
            'card_number' => $this->card_number,
            'card_month' => $this->card_month_exp,
            'card_year' => $this->card_year_exp,
            'card_cvv' => $this->card_cvv,
        ];
        $creditCardProvider = new saveCardToken();
        $payment_gateway = new paymentGateway();
        $store_card = $creditCardProvider->storeCreditCard($card_data);
        if ($store_card['status']) {
            $card_token = $store_card['data'];
            $payment_result = $payment_gateway->PayByMasterCardDirectPay($card_token, $this->invoice_id);
            if ($payment_result['status']) {
                $this->showSuccessAlert('شكرًا لك، تمت العملية بنجاح');
                $this->emit('invoice-paid');
                $this->closeMe();
            } else {
                $this->addError('card_number', $payment_result['errors']);
            }
        } else {
            $errors = $store_card['errors']->toArray();
            foreach ($errors as $key => $error) {
                $this->addError($key, $error[0]);
            }
        }
    }

    public function closeMe()
    {
        $this->emit('hide-user-pay-invoice-modal');
        $this->reset();
    }
}
