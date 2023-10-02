<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Models\Invoice;
use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoicesList extends Component
{
    use WithLazyLoad;

    public function getListeners()
    {
        return [
            'invoice-paid' => '$refresh',
        ];
    }

    public function render()
    {
        $invoices = ($this->ready_to_load)
            ? Auth::user()->invoices()->unPaid()->limit(4)->get()
            : [];
        return view('livewire.user.dashboard.invoices-list', [
            'invoices' => $invoices,
        ]);
    }

    public function payInvoice($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $this->emit('show-user-pay-invoice-modal', [
            'invoice_id' => $invoice_id,
        ]);
    }
}
