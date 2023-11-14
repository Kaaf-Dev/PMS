<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class UserReport implements FromCollection, WithHeadings, WithEvents
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = DB::table('users')
            ->select('users.name as user_name',  'users.phone as user_phone','users.cpr as user_cpr',
                'users.username as username', 'users.email as user_email',
            'users.phone as user_phone', 'users.blood as user_blood', 'users.date_of_berth as date_of_berth',
                'users.whatsapp_phone as whatsapp_phone', 'users.contact_phone as contact_phone')
            ->join('contracts', 'contracts.user_id', '=', 'users.id')
            ->join('invoices', 'invoices.contract_id', '=', 'contracts.id')
            ->leftJoin('receipts', 'receipts.invoice_id', '=', 'invoices.id')
            ->selectRaw('COUNT(CASE WHEN receipts.invoice_id IS NULL THEN invoices.id END) as unpaid_invoices')
            ->groupBy('users.name', 'users.phone','users.cpr', 'users.username', 'users.email', 'users.gender',
                'users.phone', 'users.blood', 'users.date_of_berth', 'users.whatsapp_phone', 'users.contact_phone')
            ->get();

        return $users->map(function ($user) {
            return [
                'user_name' => $user->user_name,
                'user_phone' => $user->user_phone,
                'user_cpr' => $user->user_cpr,
                'username' => $user->username,
                'user_email' => $user->user_email,
                'user_blood' => $user->user_blood,
                'date_of_berth' => $user->date_of_berth,
                'whatsapp_phone' => $user->whatsapp_phone,
                'contact_phone' => $user->contact_phone,
                'unpaid_invoices' => $user->unpaid_invoices,

            ];
        });

    }

    public function headings(): array
    {
        return [
            "أسم المستأجير",
            "رقم الهاتف",
            "الرقم الشخصي",
            "المعرف الشخصي",
            "البريد الإلكتروني",
            "فصيلة الدم",
            "تاريخ الميلاد",
            "رقم الواتس اب",
            "رقم التواصل",
            "مجموع المتأخيرات",
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
