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

class ReceiptsListReport implements FromCollection, WithHeadings ,WithEvents
{
    protected $receipts;

    public function __construct($receipts)
    {
        $this->receipts = $receipts;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->receipts->map(function ($receipt) {
            return [
                'type' => $receipt->invoice->Contract->User->name ?? '',
                'no' => $receipt->invoice->id,
                'cost' => $receipt->amount,
                'date' => $receipt->date,
                'payment_method' => $receipt->payment_method_string,
            ];
        });
    }

    public function headings(): array
    {
        return [
            "الاسم",
            "رقم الفاتورة",
            "المبلغ",
            "التاريخ",
            "طريقة الدفع",
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
