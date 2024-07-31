<?php

namespace App\Http\Livewire\Admin\Invoice;

use App\Exports\InvoicesListReport;
use App\Models\Contract;
use App\Models\Invoice;
use App\Repository\printPDF;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ready_load = false;

    public $paid_type;
    public $due_at;
    public $due_end;
    public $contract_id;
    public $search;

    public function load()
    {
        return $this->ready_load = true;
    }

    public function render()
    {
        $invoices = $this->ready_load ? $this->loadInvoices()->paginate() : [];
        $contracts = Contract::all();

        $view_data = [
            'invoices' => $invoices,
            'contracts' => $contracts,
        ];
        return view('livewire.admin.invoice.list-table', $view_data);
    }

    public function loadInvoices()
    {
        return Invoice::when($this->paid_type, function ($query) {
            if ($this->paid_type == 1) {
                return $query->Paid();
            } elseif ($this->paid_type == 2) {
                return $query->Unpaid();
            }
        })
            ->when($this->search, function ($query) {
                $query->where('no', 'like', '%' . $this->search . '%');
            })
            ->when($this->contract_id, function ($query) {
                $query->where('contract_id', $this->contract_id);
            })
            ->when($this->due_at, function ($query) {
                $query->where('due', '>=', $this->due_at);
            })
            ->when($this->due_end, function ($query) {
                $query->where('due', '<=', $this->due_end);
            });
    }

    public function exportExcel()
    {
        return Excel::download(new InvoicesListReport($this->loadInvoices()->get()), 'invoices.xlsx');
    }

    public function paidInvoice(Invoice $invoice)
    {
        if ($invoice) {
            if (!$invoice->IsPaid) {
                $this->emit('show-admin-receipt-create-modal', ['contract_id' => $invoice->contract_id, 'invoice_id' => $invoice->id]);
            } else {
                abort(404);
            }
        }

    }

    public function printInvoice(Invoice $invoice)
    {
        $file = printPDF::createPdf($invoice, $invoice->invoice_apartment_type);
        return Response::streamDownload(function () use ($file) {
            echo $file;
        }, 'invoice.pdf');
    }
}
