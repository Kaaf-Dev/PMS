<?php

namespace App\Classes\Report;

use App\Models\MaintenanceInvoice;
use App\Models\Receipt;

class ReportService
{
    public static function getPropertyRentOverview($year = 0)
    {
        $year = ($year != 0)
            ? $year
            : Date('Y');

        $receipts = Receipt::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total_amount')
            ->whereYear('date', $year)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $maintenance_invoices = MaintenanceInvoice::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total_amount')
            ->whereYear('created_at', $year)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $incomes_per_month = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];

        $expensive_per_month = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];

        foreach ($receipts as $receipt) {
            $month = $receipt->month;
            $totalAmount = $receipt->total_amount;
            $incomes_per_month[$month] += $totalAmount;
        }

        foreach ($maintenance_invoices as $maintenance_invoice) {
            $month = $maintenance_invoice->month;
            $totalAmount = $maintenance_invoice->total_amount;
            $expensive_per_month[$month] += $totalAmount;
        }

        return [
            'incomes_per_month' => array_values($incomes_per_month),
            'expensive_per_month' => array_values($expensive_per_month),
        ];
    }
}
