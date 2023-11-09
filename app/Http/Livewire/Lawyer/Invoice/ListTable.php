<?php

namespace App\Http\Livewire\Lawyer\Invoice;

use App\Models\LawyerInvoice;
use Livewire\Component;

class ListTable extends Component
{

    public $lawyer_case_id;

    public function getListeners()
    {
        return [
            'lawyer-invoices-added' => '$refresh',
        ];
    }

    public function mount($lawyer_case)
    {
        $this->lawyer_case_id = $lawyer_case;
    }

    public function render()
    {
        return view('livewire.lawyer.invoice.list-table');
    }

    public function getInvoicesProperty()
    {
        return LawyerInvoice::where('lawyer_case_id', '=', $this->lawyer_case_id)->get();
    }

    public function createInvoice()
    {
        $this->emit('show-lawyer-invoice-create-form-modal', [
            'lawyer_case_id' => $this->lawyer_case_id,
        ]);
    }
}
