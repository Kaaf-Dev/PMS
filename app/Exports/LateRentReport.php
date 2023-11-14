<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class LateRentReport implements FromCollection, WithHeadings, WithEvents
{
    protected $month_count;
    protected $selected_category;

    public function __construct($data)
    {
        $this->month_count = $data['month_count'];
        $this->selected_category = $data['selected_category'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $apartment_cost = 0;
        $users = DB::table('users')
            ->select('users.name as user_name', 'users.phone as user_phone',
                'properties.ky_no as property_no', 'properties.name as property_name'
                , 'contract_apartment.cost as apartment_cost', 'contracts.id as contract_id')
            ->Join('contracts', 'contracts.user_id', '=', 'users.id')
            ->Join('contract_apartment', 'contracts.id', '=', 'contract_apartment.contract_id')
            ->Join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
            ->Join('properties', 'apartments.property_id', '=', 'properties.id')
            ->Join('invoices', 'contracts.id', '=', 'invoices.contract_id')
            ->leftJoin('receipts', 'invoices.id', '=', 'receipts.invoice_id')
            ->selectRaw('COUNT(CASE WHEN receipts.invoice_id IS NULL THEN invoices.id END) as unpaid_invoices')
            ->having('unpaid_invoices', '>=', $this->month_count)
            ->when($this->selected_category, function ($query){
                $query->where('category_id', $this->selected_category);
            })
            ->groupBy('receipts.id', 'users.name', 'users.phone', 'properties.ky_no', 'properties.name',
                'contract_apartment.cost', 'contracts.id')
            ->distinct()
            ->get();


        $report = [];

        foreach ($users as $user) {
            $apartment_cost += $user->apartment_cost;
            $report[$user->contract_id] = [
                'user_name' => $user->user_name,
                'user_phone' => $user->user_phone,
                'property_no' => $user->property_no,
                'property_name' => $user->property_name,
                'apartment_cost' => $user->apartment_cost,
                'unpaid_invoices' => $user->unpaid_invoices,

            ];

        }
        $report[] = [
            'user_name' => '',
            'user_phone' => '',
            'property_no' => '',
            'property_name' => '',
            'apartment_cost' => number_format($apartment_cost, 3),
            'unpaid_invoices' => '',
        ];

        return collect($report);

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
