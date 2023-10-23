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

class ApartmentListReport implements FromCollection, WithHeadings ,WithEvents
{
    protected $apartments;

    public function __construct($apartments)
    {
        $this->apartments = $apartments;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return $this->apartments->map(function ($apartment) {
            return [
                'id' => $apartment->id,
                'type' => $apartment->TypeString,
                'apartment' => $apartment->name,
                'property' => $apartment->property->name,
                'cost' => $apartment->cost,
                'status' => $apartment->ContractActiveStatusString,
                'rooms_count' => $apartment->rooms_count,
                'bathrooms_count' => $apartment->bathrooms_count,
            ];
        });

    }

    public function headings(): array
    {
        return [
            "#",
            "الفئة",
            "الوحدة السكنية",
            "العقار",
            "قيمة الاجار",
            "حالة الوحدة",
            "عدد الغرف",
            "عدد دورات المياة",
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
