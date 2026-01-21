<?php

namespace App\Http\Livewire\Admin\Report\Form;

use App\Exports\TicketListReport;
use App\Models\Ticket;
use App\Repository\printPDF;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class TicketList extends Component
{

    public $selected_year;
    public $from_year;
    public $to_year;

    public function rules()
    {
        return [
            'selected_year' => 'nullable',
            'from_year' => 'nullable|integer',
            'to_year'   => 'nullable|integer|gte:from_year',
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

        if ($this->from_year && $this->to_year) {
            $tickets->whereBetween(
                'created_at',
                [
                    Carbon::create($this->from_year, 1, 1)->startOfDay(),
                    Carbon::create($this->to_year, 12, 31)->endOfDay(),
                ]
            );
        } elseif ($this->from_year) {
            $tickets->whereYear('created_at', $this->from_year);
        }

        $tickets = $tickets
            ->with([
                'contract',
                'contract.user',
                'apartment',
                'apartment.property',
                'maintenanceInvoices',
            ])
            ->withSum('maintenanceInvoices', 'amount')
            ->get();

        $report = [];

        foreach ($tickets as $ticket) {
            $diffDays = null;

            if ($ticket->assigned_at) {
                $diffDays = Carbon::parse($ticket->created_at)
                    ->diffInDays(Carbon::parse($ticket->assigned_at));
            }

            $report[$ticket->id] = [
                'id'          => $ticket->id,
                'user'        => $ticket->contract?->user?->name ?? '',
                'apartment'   => $ticket->apartment?->name ?? '',
                'property'    => $ticket->apartment?->property?->name ?? '',
                'property_no' => $ticket->apartment?->property?->ky_no ?? '',
                'subject'     => $ticket->subject,
                'category'    => $ticket->category->title ?? '-- غير محدد --',
                'created_at'  => $ticket->created_at,
                'assigned_at' => $ticket->assigned_at,
                'diffDays'    => $diffDays,
                'visited_at'  => $ticket->visited_at,
                'cost'        => $ticket->maintenance_invoices_sum_amount,
                'status'      => $ticket->statusString,
            ];
        }

        return $report;
    }




    public function closeModal()
    {
        $this->emit('hide-admin-report-ticket-list-modal');
    }


}

