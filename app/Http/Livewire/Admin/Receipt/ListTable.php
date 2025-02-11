<?php

namespace App\Http\Livewire\Admin\Receipt;

use App\Exports\ReceiptsListReport;
use App\Models\Contract;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Repository\printPDF;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ready_load = false;
    public $search;
    public $payment_method;
    public $due_at; // Added this
    public $due_end; // Added this
    public $contract_id;


    public function load()
    {
        return $this->ready_load = true;
    }

    public function render()
    {
        $receipts = $this->ready_load ? $this->loadReceipts()->paginate() : [];
        $contracts = Contract::all();
        $view_data = [
            'contracts' => $contracts,
            'receipts' => $receipts,
        ];
        return view('livewire.admin.receipt.list-table', $view_data);
    }

    public function loadReceipts()
    {
        return Receipt::when($this->search, function ($query) {
            $query->where('no', 'like', '%' . $this->search . '%');
        })
            ->when($this->contract_id, function ($query) {
                $query->whereHas('invoice', function ($query) {
                    $query->where('contract_id', $this->contract_id); // هنا يتم تصفية الاستعلام بناءً على contract_id في جدول الفواتير
                });
            })
            ->when($this->due_at, function ($query) {
                $query->whereDate('created_at', '>=', $this->due_at);
            })
            ->when($this->due_end, function ($query) {
                $query->whereDate('created_at', '<=', $this->due_end);
            })
            ->orderBy('created_at', 'desc');
    }


    public function exportExcel()
    {
        return Excel::download(new ReceiptsListReport($this->loadReceipts()->get()), 'receipts.xlsx');
    }

    public function printReceipt(Receipt $receipt)
    {
        $file = printPDF::createPdf($receipt, $receipt->invoice->receipt_apartment_type);
        return Response::streamDownload(function () use ($file) {
            echo $file;
        }, 'receipt.pdf');
    }
}
