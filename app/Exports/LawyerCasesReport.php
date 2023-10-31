<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\LawyerCase;
use App\Models\Property;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class LawyerCasesReport implements FromCollection, WithHeadings, WithEvents
{
    protected $selected_lawyer;

    public function __construct($selected_lawyer)
    {
        $this->selected_lawyer = $selected_lawyer;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $lawyer_cases = LawyerCase::query();

        if ($this->selected_lawyer > 0) {
            $lawyer_cases = $lawyer_cases->where('lawyer_id', '=', $this->selected_lawyer);
        }

        $lawyer_cases = $lawyer_cases
            ->with([
                'lawyer',
                'contract',
                'court',
                'status',
            ])
            ->get();

        $report = [];

        foreach ($lawyer_cases as $lawyer_case) {
            $report[$lawyer_case->id] = [
                'id' => $lawyer_case->id,
                'collected_amount' => $lawyer_case->collected_amount,
                'amount' => $lawyer_case->amount,
                'status' => optional($lawyer_case->status)->title,
                'first_side' => $lawyer_case->first_side,
                'second_side' => $lawyer_case->second_side,
                'case_no' => $lawyer_case->case_no,
            ];
        }


        return collect($report);
    }

    public function headings(): array
    {
        return [
            "#",
            "المبلغ المحصل",
            "المبلغ المحكوم به",
            "الحالة",
            "المنفذ له",
            "المنفذ ضده",
            "رقم الدعوى",
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
