<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class RentCollectionReport implements FromCollection, WithHeadings,WithEvents
{
    protected $contract_id;
    protected $user_id;

    public function __construct($params = [])
    {
        if (isset($params['contract_id'])) {
            $this->contract_id = $params['contract_id'];
        }

        if (isset($params['user_id'])) {
            $this->user_id = $params['user_id'];
        }
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $contracts = Contract::query();

        if ($this->contract_id > 0) {
            $contracts = $contracts->where('contract_id', '=', $this->contract_id);
        }

        if ($this->user_id > 0) {
            $contracts = $contracts->where('user_id', '=', $this->user_id);
        }

        $contracts = $contracts->with([
            'user',
            'invoices',
        ])->get();

        $report = [];
        foreach ($contracts as $contract) {
            $report[$contract->id] = [
                'contract_id' => $contract->id,
                'user' => optional($contract->user)->name ?? '-',
                'total' => $contract->invoices_total ?? 0,
                'paid' => $contract->receipts_total ?? 0,
                'collect_percent' => ($contract->invoices_total > 0)
                    ? number_format(round(($contract->receipts_total / $contract->invoices_total) * 100), '2') . '%'
                    : 0,
            ];
        }



        return collect($report);
    }

    public function headings(): array
    {
        return [
            "رقم العقد",
            "المستأجر",
            "مبلغ التحصيل",
            "المحصل فعليًا",
            "نسبة التحصيل",
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
