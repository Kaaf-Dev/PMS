<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Models\Invoice;
use App\Repository\printPDF;
use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReceiptList extends Component
{
    use WithLazyLoad;

    public function render()
    {
        $invoices = ($this->ready_to_load)
            ? Auth::user()->invoices()->Paid()->orderBy('due','DESC')->limit(4)->get()
            :
            [];
        return view('livewire.user.dashboard.receipt-list', [
            'invoices' => $invoices,
        ]);
    }

    public function printReceipt($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        return printPDF::createPdf($invoice, 'pdf.invoice', [400, 295], 'invoices_file');
    }
}
