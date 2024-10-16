<?php

namespace App\Http\Livewire\User\Contract\Details;

use App\Models\Invoice;
use App\Repository\printPDF;
use Illuminate\Support\Facades\Response;
use Livewire\Component;

class InvoicesList extends Component
{
    public $contract_id;

    public function getListeners()
    {
        return [
            'invoice-paid' => '$refresh',
        ];
    }

    public function mount($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.user.contract.details.invoices-list');
    }

    public function getInvoicesProperty()
    {
        $invoices = Invoice::with([
            'receipts',
        ])->where([
            ['contract_id', '=', $this->contract_id]
        ])->orderBy('date', 'desc')
            ->get();

        return $invoices->groupBy(function ($item, $key) { // arrange by year
            return $item->date->format('Y');
        });
    }

    public function payInvoice($invoice_id)
    {
        $this->emit('show-user-pay-invoice-modal', [
            'invoice_id' => $invoice_id,
        ]);
    }

    public function printReceipt($invoice_id)
    {
        $invoice = Invoice::where([
            ['contract_id', '=', $this->contract_id]
        ])->findOrFail($invoice_id);
        if ($invoice) {
            $file = printPDF::createPdf($invoice, $invoice->invoice_apartment_type);
            return Response::streamDownload(function () use ($file) {
                echo $file;
            }, 'invoice.pdf');
        }
    }
}
