<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Models\Invoice;
use App\Repository\printPDF;
use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Livewire\Component;

class ReceiptList extends Component
{
    use WithLazyLoad;

    public function render()
    {
        $invoices = ($this->ready_to_load)
            ? Auth::user()->invoices()->Paid()->orderBy('due', 'DESC')->limit(4)->get()
            :
            [];
        return view('livewire.user.dashboard.receipt-list', [
            'invoices' => $invoices,
        ]);
    }

    public function printReceipt($invoice_id)
    {
        $invoice = Auth::user()->invoices()->findOrFail($invoice_id);
        if ($invoice) {
            $file = printPDF::createPdf($invoice, $invoice->invoice_apartment_type);
            return Response::streamDownload(function () use ($file) {
                echo $file;
            }, 'invoice.pdf');
        }
    }
}
