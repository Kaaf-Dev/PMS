<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExecutiveSummaryReport implements FromCollection, WithHeadings
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
        $properties = DB::table('properties')
            ->select('properties.name as property_name', 'properties.ky_no as property_ky_no')
            ->selectRaw('SUM(IF(apartments.type = 1, 1, 0)) as apartment_with_type_1_count')
            ->selectRaw('SUM(IF(apartments.type = 2, 1, 0)) as apartment_with_type_2_count')
            ->selectRaw('SUM(1) as sum_of_apartments')
            ->selectRaw('SUM(IF(contracts.active = 1, contract_apartment.cost, 0)) as total_amount_for_active_contract')
            ->leftJoin('apartments', 'properties.id', '=', 'apartments.property_id')
            ->leftJoin('contract_apartment', 'apartments.id', '=', 'contract_apartment.apartment_id')
            ->leftJoin('contracts', 'contract_apartment.contract_id', '=', 'contracts.id');

        if ($this->category > 0) {
            $properties = $properties->where('category_id', '=', $this->category);
        }

        $properties = $properties->groupBy('properties.name', 'properties.ky_no')
            ->get();

        $properties = $properties->map(function ($item) {
            return [
                'property_name' => $item->property_name,
                'property_ky_no' => $item->property_ky_no,
                'apartment_with_type_1_count' => $item->apartment_with_type_1_count,
                'apartment_with_type_2_count' => $item->apartment_with_type_2_count,
                'sum_of_apartments' => $item->sum_of_apartments,
                'total_amount_for_active_contract' => $item->total_amount_for_active_contract,
            ];
        });

        return $properties;
    }

    public function headings(): array
    {
        return [
            "العقار",
            "الرقم في النظام الخيري",
            "الشقق السكنية",
            "المحلات التجاريةس",
            "مجموع الوحدات",
            "إجمالي المبلغ الشهري",
        ];
    }
}
