<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\LawyerCase;
use App\Models\Property;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class LawyerCasesReport implements FromCollection, WithHeadings, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            "#",
            "المبلغ المحصل",
            "المبلغ المحكوم به",
            "الحالة",
            "المنفذ له",
            "المنفذ ضده",
            "رقم الدعوى",
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
