<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Models\Invoice;
use App\Repository\printPDF;
use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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

    public function printInvoice($invoice_id)
    {
        $user = Auth::user();

        // Query the user's invoices to find the specific invoice
        $invoice = $user->invoices()->findOrFail($invoice_id);

        if ($invoice) {
            $file = printPDF::createPdf($invoice, $invoice->invoice_apartment_type);
            return response()->streamDownload(function () use ($file) {
                echo $file;
            }, 'invoice.pdf');
        }
    }

}
