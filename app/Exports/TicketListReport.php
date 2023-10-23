<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\Property;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class TicketListReport implements FromCollection, WithHeadings, WithEvents
{
    protected $selected_year;

    public function __construct($selected_year)
    {
        $this->selected_year = $selected_year;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $tickets = Ticket::query();

        if ($this->selected_year > 0) {
            $tickets = $tickets->whereYear('created_at', '>=', $this->selected_year);
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
            $report[$ticket->id] = [
                'id' => $ticket->id,
                'user' => $ticket->contract->user->name,
                'apartment' => optional($ticket->apartment)->name,
                'property' => optional(optional($ticket->apartment)->property)->name,
                'property_no' => optional(optional($ticket->apartment)->property)->ky_no,
                'subject' => $ticket->subject,
                'category' => optional($ticket->category)->title ?? '-- غير محدد --',
                'created_at' => $ticket->created_at,
                'assigned_at' => $ticket->assigned_at,
                'visited_at' => $ticket->visited_at,
                'cost' => $ticket->maintenance_invoices_sum_amount,
                'status' => $ticket->statusString,
            ];
        }


        return collect($report);
    }

    public function headings(): array
    {
        return [
            "#",
            "المستأجر",
            "الوحدة",
            "العقار",
            "رقم العقار",
            "الموضوع",
            "الفئة",
            "تاريخ استلام الطلب",
            "تاريخ تحويل الطلب لشركة الصيانة",
            "تاريخ إنجاز الصيانة",
            "مبلغ التكلفة",
            "الحالة",
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }
}
