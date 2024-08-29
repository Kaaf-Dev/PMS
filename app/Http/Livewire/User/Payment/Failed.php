<?php

namespace App\Http\Livewire\User\Payment;

use App\Models\Invoice;
use Livewire\Component;

class Failed extends Component
{
    public $invoice;

    public function mount($invoice_id)
    {
        $invoice_id = decrypt($invoice_id);
        $this->invoice = Invoice::findOrFail($invoice_id);
    }

    public function render()
    {
        return view('livewire.user.payment.failed')->layout('layouts.user.app');
    }
}
