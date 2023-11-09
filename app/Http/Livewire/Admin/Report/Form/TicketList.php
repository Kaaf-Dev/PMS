<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\TicketListReport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class TicketList extends Component
{

    public $selected_year;

    public function rules()
    {
        return [
            'selected_year' => 'nullable',
        ];
    }

    public function getListeners()
    {
        return [
            'show-admin-report-ticket-list-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.report.form.ticket-list');
    }

    public function resolveParams()
    {
        $this->reset();
    }

    public function getYearsProperty()
    {
        $years = [];
        for ($i = date('Y'); $i >= 1970 ; $i--) {
            $years[] = [
                'id' => $i,
                'year' => $i,
            ];
        }
        return $years;
    }

    public function export()
    {
        return Excel::download(new TicketListReport($this->selected_year), 'ticket-list.xlsx');
    }

    public function closeModal()
    {
        $this->emit('hide-admin-report-ticket-list-modal');
    }



}

