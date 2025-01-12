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
