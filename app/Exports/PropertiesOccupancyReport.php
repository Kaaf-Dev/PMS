<?php

namespace App\Exports;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PropertiesOccupancyReport implements FromCollection, WithHeadings, WithEvents
{
    protected $data;

    public function __construct($data = null)
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
            "العقار",
            "عدد الوحدات المؤجرة",
            "مبلغ الوحدات المؤجرة",
            "تسبة الوحدات المؤجرة",

            "عدد الوحدات غير المؤجرة",
            "مبلغ الوحدات غير المؤجرة",
            "نسبة الوحدات غير المؤجرة",

            "مجموع الوحدات",
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
