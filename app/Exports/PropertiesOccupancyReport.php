<?php

namespace App\Exports;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertiesOccupancyReport implements FromCollection, WithHeadings
{
    protected $category;
    public function __construct($category = null)
    {
        $this->category = $category;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $properties = Property::with([
            'apartments',
        ]);

        if ($this->category > 0) {
            $properties = $properties->where('category_id', '=', $this->category);
        }
        $properties = $properties->get();

        foreach ($properties as $property) {
            $report[$property->id] = [
                'property' => '',

                'rented_count' => 0,
                'rented_cost' => 0,
                'rented_percent' => 0,

                'available_count' => 0,
                'available_cost' => 0,
                'available_percent' => 0,
            ];

            $report[$property->id]['property'] = $property->name;
            foreach ($property->apartments as $apartment) {
                if ($apartment->isRented) {
                    $report[$property->id]['rented_count'] = ($report[$property->id]['rented_count'] ?? 0) + 1;
                    $report[$property->id]['rented_cost'] = ($report[$property->id]['rented_cost'] ?? 0) + $apartment->currentRentedCost;
                } else {
                    $report[$property->id]['available_count'] = ($report[$property->id]['available_count'] ?? 0) + 1;
                    $report[$property->id]['available_cost'] = ($report[$property->id]['available_cost'] ?? 0) + $apartment->cost;
                }
            }
            $report[$property->id]['total'] = $report[$property->id]['rented_count'] + $report[$property->id]['available_count'];
            if ($report[$property->id]['total'] > 0) {
                $report[$property->id]['rented_percent'] = $report[$property->id]['rented_count'] / $report[$property->id]['total'];
                $report[$property->id]['available_percent'] = $report[$property->id]['available_count'] / $report[$property->id]['total'];
            }
        }

        return collect($report);
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
}
