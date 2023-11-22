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
    protected $month_count;
    protected $selected_category;
    protected $lawyer_cases;

    public function __construct($data)
    {
        $this->month_count = $data['month_count'];
        $this->selected_category = $data['selected_category'];
        $this->lawyer_cases = $data['lawyer_cases'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = DB::table('users')
            ->select('users.name as user_name', 'users.phone as user_phone', 'users.id as user_id', 'contracts.id as contract_id')
            ->join('contracts', 'users.id', '=', 'contracts.user_id')
            ->Join('invoices', 'contracts.id', '=', 'invoices.contract_id')
            ->leftJoin('receipts', function ($join) {
                $join->on('invoices.id', '=', 'receipts.invoice_id')
                    ->whereRaw('contracts.id = invoices.contract_id');
            })
            ->selectRaw('COUNT(CASE WHEN receipts.invoice_id IS NULL THEN invoices.id END) as unpaid_invoices')
            ->selectRaw('SUM(CASE WHEN receipts.invoice_id IS NULL THEN invoices.amount ELSE 0 END) as unpaid_invoices_sum')
            ->having('unpaid_invoices', '>=', $this->month_count)
            ->groupBy('users.id', 'users.name', 'users.phone', 'contracts.id')
            ->distinct('contracts.id')
            ->get();

        $report = [];
        $lawyer_cases = LawyerCase::pluck('contract_id');
        foreach ($users as $user) {
            $contracts = Contract::where('user_id', $user->user_id)->where('id', $user->contract_id)->get();
            if ($this->lawyer_cases == 1) {
                $contracts = $contracts->whereNotIn('id', $lawyer_cases);
            } elseif ($this->lawyer_cases == 2) {
                $contracts = $contracts->whereIn('id', $lawyer_cases);
            }
            foreach ($contracts as $contract) {
                $apartments = $contract->contractApartments;
                foreach ($apartments as $contractApartment) {
                    $category = $contractApartment->apartment->Property->category;
                    if ($category->id == $this->selected_category or $this->selected_category == null) {
                        $report[$user->user_id . $user->contract_id] = [
                            'user_name' => $user->user_name,
                            'user_phone' => $user->user_phone,
                            'property_no' => $contractApartment->apartment->Property->ky_no,
                            'property_name' => $contractApartment->apartment->Property->name,
                            'apartment_cost' => $contract->Cost,
                            'unpaid_invoices' => $user->unpaid_invoices,
                            'unpaid_invoices_sum' => number_format($user->unpaid_invoices_sum, 3),
                        ];
                    }
                }
            }


        }

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
