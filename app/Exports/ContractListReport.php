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

class ContractListReport implements FromCollection, WithHeadings, WithEvents
{
    protected $contracts;

    public function __construct($contracts)
    {
        $this->contracts = $contracts;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $result = [];
        foreach ($this->contracts as $contract) {
            foreach ($contract->contractApartments as $apartment) {
                $result[] = [
                    'user_name' => $contract->User->name,
                    'user_phone' => $contract->User->phone,
                    'property_name' => $apartment->apartment->property->name,
                    'apartment_name' => $apartment->apartment->name,
                    'contract_status' => $apartment->contract->active_status_string,
                    'contract_cost' => $apartment->cost,
                    'start_at' => $contract->start_at_human,
                    'end_at' => $contract->end_at_human,
                    'Lawyer_case' => $contract->is_lawyerable ? 'محول الى محامي'  : "غير محول"
                ];
            }
        }
        return collect($result);
    }


    public function headings(): array
    {
        return [
            "اسم المستأجر",
            "رقم الهاتف",
            "اسم المبنى",
            "اسم الشقة",
            "حالة العقد",
            "الاجار الشهري",
            "تاريخ البداية",
            "تاريخ النهاية",
            "الحالة القانونية",
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
