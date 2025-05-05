<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Models\Contract;
use App\Models\Invoice;
use App\Repository\printPDF;
use App\Traits\WithAlert;
use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Livewire\Component;

class InvoicesList extends Component
{
    use WithLazyLoad;
    use WithAlert;

    public function getListeners()
    {
        return [
            'invoice-paid' => '$refresh',
        ];
    }

    public function render()
    {
        $invoices = ($this->ready_to_load)
            ? Auth::user()->invoices()->unPaid()->orderByDesc('due')->limit(4)->get()
            : [];
        return view('livewire.user.dashboard.invoices-list', [
            'invoices' => $invoices,
        ]);
    }

    public function printInvoice($invoice_id)
    {
        $invoice = Auth::user()->invoices()->findOrFail($invoice_id);
        if ($invoice) {
            $file = printPDF::createPdf($invoice, $invoice->invoice_apartment_type);
            return Response::streamDownload(function () use ($file) {
                echo $file;
            }, 'invoice.pdf');
        }
    }

    public function payInvoice($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $contract = Contract::find($invoice->contract_id);

        if (!$contract) {
            $this->showWarningAlert('العقد غير موجود.');
            return;
        }

        $unpaidInvoicesBefore = $contract->invoices()
            ->unPaid()
            ->where('due', '<', $invoice->due)
            ->orderBy('due', 'asc')
            ->get();

        if ($unpaidInvoicesBefore->isNotEmpty()) {
            $this->showWarningAlert('يرجى تسديد الفواتير غير المدفوعة للأشهر السابقة أولًا.');
        } else {
            $this->emit('show-user-pay-invoice-modal', [
                'invoice_id' => $invoice_id,
            ]);
        }
    }

}
