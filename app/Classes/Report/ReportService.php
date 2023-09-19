<?php

namespace App\Classes\Report;

use App\Models\Apartment;
use App\Models\Contract;
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

    public static function getOccupancyOverview()
    {

        // Prepare variables //
        $rented_count = 0;
        $rented_percent = 0;
        $available_count = 0;
        $available_percent = 0;

        $apartment_count = 0;
        $apartment_percent = 0;
        $apartment_rented_count = 0;
        $apartment_rented_percent = 0;
        $apartment_available_count = 0;
        $apartment_available_percent = 0;

        $store_count = 0;
        $store_percent = 0;
        $store_rented_count = 0;
        $store_rented_percent = 0;
        $store_available_count = 0;
        $store_available_percent = 0;

        // fetch data from database //
        $all_apartments_count = Apartment::get()
            ->groupBy('type')
            ->map(function ($apartments) {
                return $apartments->count();
            });

        $types_rented = Contract::active()
            ->with('apartments.property')
            ->get()
            ->pluck('apartments')
            ->flatten()
            ->groupBy('type') // Group apartments by type
            ->map(function ($apartments) {
                return $apartments->count();
            });


        // data processing //
        foreach ($all_apartments_count as $type => $type_count) {
            if ($type == Apartment::TYPE_HOUSE) {
                $apartment_count = $type_count;

            } elseif ($type == Apartment::TYPE_STORE) {
                $store_count = $type_count;
            }
        }

        foreach ($types_rented as $type => $type_rented) {
            if ($type == Apartment::TYPE_HOUSE) {
                $apartment_rented_count = $type_rented;

            } elseif ($type == Apartment::TYPE_STORE) {
                $store_rented_count = $type_rented;
            }
        }

        // data calculations //
        $apartment_available_count = $apartment_count - $apartment_rented_count;
        $store_available_count = $store_count - $store_rented_count;

        $rented_count = $apartment_rented_count + $store_rented_count;
        $available_count = $apartment_available_count + $store_available_count;

        if ($available_count + $rented_count > 0) {
            $rented_percent = round(($rented_count / ($available_count + $rented_count)) * 100);
        }

        if ($available_count + $rented_count > 0) {
            $available_percent = round(($available_count / ($available_count + $rented_count)) * 100);
        }

        if ($apartment_available_count + $apartment_rented_count) {
            $apartment_rented_percent = round( ($apartment_rented_count / ($apartment_available_count + $apartment_rented_count)) * 100 );
        }

        if ($apartment_available_count + $apartment_rented_count > 0) {
            $apartment_available_percent = round( ($apartment_available_count / ($apartment_available_count + $apartment_rented_count)) * 100 );
        }

        if ($store_available_count + $store_rented_count > 0) {
            $store_rented_percent = round( ($store_rented_count / ($store_available_count + $store_rented_count)) * 100 );
        }

        if ($store_available_count + $store_rented_count) {
            $store_available_percent = round( ($store_available_count / ($store_available_count + $store_rented_count)) * 100 );
        }

        // return data //
        return [
            'rented_count' => $rented_count,
            'rented_percent' => $rented_percent,

            'available_count' => $available_count,
            'available_percent' => $available_percent,

            'apartment_count' => $apartment_count,
            'apartment_percent' => $apartment_percent,
            'apartment_rented_count' => $apartment_rented_count,
            'apartment_rented_percent' => $apartment_rented_percent,
            'apartment_available_count' => $apartment_available_count,
            'apartment_available_percent' => $apartment_available_percent,

            'store_count' => $store_count,
            'store_percent' => $store_percent,
            'store_rented_count' => $store_rented_count,
            'store_rented_percent' => $store_rented_percent,
            'store_available_count' => $store_available_count,
            'store_available_percent' => $store_available_percent,
        ];
    }

    public static function getRentalsOverview()
    {

        $rents_amount = 0;
        $rents_percent = 0;

        $available_amount = 0;
        $available_percent = 0;

        $apartment_rents_amount = 0;
        $apartment_rents_percent = 0;

        $apartment_available_amount = 0;
        $apartment_available_percent = 0;

        $store_rents_amount = 0;
        $store_rents_percent = 0;

        $store_available_amount = 0;
        $store_available_percent = 0;

        $reports_rents = Contract::active()
            ->join('contract_apartment', 'contracts.id', '=', 'contract_apartment.contract_id')
            ->join('apartments', 'apartments.id', '=', 'contract_apartment.apartment_id')
            ->whereNull('contracts.deleted_at')
            ->select('apartments.type', \DB::raw('SUM(contract_apartment.cost) as total_cost'))
            ->groupBy('apartments.type')
            ->get();

        $reports_available = Apartment::available()
            ->select('type', \DB::raw('SUM(cost) as total_cost'))
            ->groupBy('type')
            ->get();

        foreach ($reports_rents as $report_rent) {
            if ($report_rent->type == Apartment::TYPE_HOUSE) {
                $apartment_rents_amount = $report_rent->total_cost;
            }

            if ($report_rent->type == Apartment::TYPE_STORE) {
                $store_rents_amount = $report_rent->total_cost;
            }
        }

        foreach ($reports_available as $report_available) {
            if ($report_available->type == Apartment::TYPE_HOUSE) {
                $apartment_available_amount = $report_available->total_cost;
            }

            if ($report_available->type == Apartment::TYPE_STORE) {
                $store_available_amount = $report_available->total_cost;
            }
        }

        $rents_amount = $apartment_rents_amount + $store_rents_amount;
        $available_amount = $apartment_available_amount + $store_available_amount;

        if ($rents_amount + $available_amount > 0) {
            $rents_percent = round( ($rents_amount / ($rents_amount + $available_amount) ) * 100 );
        }

        if ($rents_amount + $available_amount > 0) {
            $available_percent = round( ($available_amount / ($rents_amount + $available_amount) ) * 100 );
        }

        if ($apartment_rents_amount + $apartment_available_amount > 0) {
            $apartment_rents_percent = round( ($apartment_rents_amount / ($apartment_rents_amount + $apartment_available_amount)) * 100 );
        }

        if ($apartment_rents_amount + $apartment_available_amount > 0) {
            $apartment_available_percent = round( ($apartment_available_amount / ($apartment_rents_amount + $apartment_available_amount)) * 100 );
        }

        if ($store_rents_amount + $store_available_amount > 0) {
            $store_rents_percent = round( ($store_rents_amount / ($store_rents_amount + $store_available_amount)) * 100 );
        }

        if ($store_rents_amount + $store_available_amount > 0) {
            $store_available_percent = round( ($store_available_amount / ($store_rents_amount + $store_available_amount)) * 100 );
        }

        return [
            'rents_amount' => $rents_amount,
            'rents_percent' => $rents_percent,

            'available_amount' => $available_amount,
            'available_percent' => $available_percent,

            'apartment_rents_amount' => $apartment_rents_amount,
            'apartment_rents_percent' => $apartment_rents_percent,

            'apartment_available_amount' => $apartment_available_amount,
            'apartment_available_percent' => $apartment_available_percent,

            'store_rents_amount' => $store_rents_amount,
            'store_rents_percent' => $store_rents_percent,

            'store_available_amount' => $store_available_amount,
            'store_available_percent' => $store_available_percent,
        ];
    }

}
