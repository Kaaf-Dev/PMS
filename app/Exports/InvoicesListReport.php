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

class InvoicesListReport implements FromCollection, WithHeadings ,WithEvents
{
    protected $invoices;

    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return $this->invoices->map(function ($invoice) {
            return [
                'id' => $invoice->no,
                'type' => $invoice->Contract->User->name ?? '',
                'contract' => $invoice->Contract->id ?? '',
                'cost' => $invoice->amount,
                'date' => $invoice->due,
                'status' => $invoice->PaidString,
            ];
        });

    }

    public function headings(): array
    {
        return [
            "#",
            "الاسم",
            "رقم العقد",
            "المبلغ",
            "التاريخ",
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
