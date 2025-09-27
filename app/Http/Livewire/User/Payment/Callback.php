<?php

namespace App\Http\Livewire\User\Payment;

use App\Models\PaymentTransaction;
use Livewire\Component;

class Callback extends Component
{
    public $transaction;

    public function mount($globalTransactionsId)
    {
        sleep(5);
        if ($globalTransactionsId) {
            $this->transaction = PaymentTransaction::where('global_transaction_id', $globalTransactionsId)->first();
            if ($this->transaction) {
                if (!$this->transaction->is_paid) {
                    return redirect()->route('user.success.payment', encrypt($this->transaction->invoice_id));
                }
            }
        }
        return redirect()->route('user.failed.payment', encrypt($this->transaction->invoice_id));
    }

    public function render()
    {
        return view('livewire.user.payment.callback');
    }
}
