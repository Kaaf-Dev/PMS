<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\LawyerCase;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class LateRentReport implements FromCollection, WithHeadings, WithEvents
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
            "أسم المستأجير",
            "رقم الهاتف",
            "رقم العقار",
            "أسم العقار",
            "قيمة الإيجار الشهري",
            "عدد الأشهر المتأخرة",
            "مجموع المتأخرات",

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

}
