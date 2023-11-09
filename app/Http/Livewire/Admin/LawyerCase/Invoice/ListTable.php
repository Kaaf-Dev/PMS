<?php

namespace App\Http\Livewire\Admin\LawyerCase\Invoice;

use App\Models\LawyerInvoice;
use Livewire\Component;

class ListTable extends Component
{

    public $lawyer_case_id;

    public function getListeners()
    {
        return [
            'lawyer-invoices-updated' => '$refresh',
            'lawyer-invoices-added' => '$refresh',
        ];
    }

    public function mount($lawyer_case)
    {
        $this->lawyer_case_id = $lawyer_case;
    }

    public function getInvoicesProperty()
    {
        return LawyerInvoice::where('lawyer_case_id', '=', $this->lawyer_case_id)->get();
    }


    public function render()
    {
        return view('livewire.admin.lawyer-case.invoice.list-table');
    }

    public function createInvoice()
    {
        $this->emit('show-admin-lawyer-case-invoice-create-modal', [
            'lawyer_case_id' => $this->lawyer_case_id,
        ]);
    }

    public function updateInvoice($invoice_id)
    {
        $this->emit('show-admin-lawyer-case-invoice-update-modal', [
            'invoice_id' => $invoice_id,
        ]);
    }

}
