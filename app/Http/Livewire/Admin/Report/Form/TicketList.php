<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\TicketListReport;
use App\Models\Ticket;
use App\Repository\printPDF;
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
        for ($i = date('Y'); $i >= 1970; $i--) {
            $years[] = [
                'id' => $i,
                'year' => $i,
            ];
        }
        return $years;
    }

    public function exportExcel()
    {
        return Excel::download(new TicketListReport($this->getReportData()), 'ticket-list.xlsx');
    }

    public function exportPDF()
    {
        $data = [
            'data'=> $this->getReportData(),
            'selected_year' => $this->selected_year
        ];

        $printPDF = new printPDF();
        $file = $printPDF->createPDF($data, 'pdf.tickets-list-report', 'A4-L');

        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="properties-occupancy-report.pdf"'
        ]);
    }

    public function getReportData()
    {
        $tickets = Ticket::query();

        if ($this->selected_year > 0) {
            $tickets = $tickets->whereYear('created_at', '>=', $this->selected_year);
        }

        $tickets = $tickets
            ->with([
                'contract',
                'contract.user',  // Ensure user relationship is loaded
                'apartment',
                'apartment.property',
                'maintenanceInvoices',
            ])
            ->withSum('maintenanceInvoices', 'amount')
            ->get();

        $report = [];

        foreach ($tickets as $ticket) {
            $report[$ticket->id] = [
                'id' => $ticket->id,
                'user' => $ticket->contract ? $ticket->contract->User->name : '',
                'apartment' => $ticket->apartment ? $ticket->apartment->name : '',
                'property' => $ticket->apartment ? $ticket->apartment->property->name : '',
                'property_no' => $ticket->apartment ? $ticket->apartment->property->ky_no : '',
                'subject' => $ticket->subject,
                'category' => $ticket->category->title ?? '-- غير محدد --',
                'created_at' => $ticket->created_at,
                'assigned_at' => $ticket->assigned_at,
                'diffDays' => $ticket->diff_days,
                'visited_at' => $ticket->visited_at,
                'cost' => $ticket->maintenance_invoices_sum_amount,
                'status' => $ticket->statusString,
            ];
        }

        return $report;
    }


    public function closeModal()
    {
        $this->emit('hide-admin-report-ticket-list-modal');
    }


}

