<?php

namespace App\Classes\Report;

use App\Models\Apartment;
use App\Models\Contract;
use App\Models\Discount;
use App\Models\Invoice;
use App\Models\MaintenanceInvoice;
use App\Models\Receipt;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public static function getPropertyRentOverview($year = 0, $type)
    {
        $year = ($year != 0)
            ? $year
            : Date('Y');

//        $receipts = Receipt::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total_amount')
//            ->whereYear('date', $year)
//            ->groupBy('year', 'month')
//            ->orderBy('year', 'asc')
//            ->orderBy('month', 'asc')
//            ->get();

        $receipts = DB::table('properties')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })
            ->selectRaw('YEAR(receipts.date) as year, MONTH(receipts.date) as month, SUM(receipts.amount) as total_amount')
            ->join('apartments', 'properties.id', '=', 'apartments.property_id')
            ->join('contract_apartment', 'apartments.id', '=', 'contract_apartment.apartment_id')
            ->join('invoices', 'contract_apartment.contract_id', '=', 'invoices.contract_id')
            ->join('receipts', 'invoices.id', '=', 'receipts.invoice_id')
            ->whereYear('receipts.date', $year)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

//        $maintenance_invoices = MaintenanceInvoice::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total_amount')
//            ->whereYear('created_at', $year)
//            ->groupBy('year', 'month')
//            ->orderBy('year', 'asc')
//            ->orderBy('month', 'asc')
//            ->get();

        $maintenance_invoices = DB::table('tickets')
            ->selectRaw('YEAR(maintenance_invoices.created_at) as year, MONTH(maintenance_invoices.created_at) as month, SUM(maintenance_invoices.amount) as total_amount')
            ->join('properties', 'tickets.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })
            ->join('maintenance_invoices', 'tickets.id', '=', 'maintenance_invoices.ticket_id')
            ->whereYear('maintenance_invoices.created_at', $year)
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

    public static function getOccupancyOverview($type)
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
//        $all_apartments_count = Apartment::get()
//
//            ->groupBy('type')
//            ->map(function ($apartments) {
//                return $apartments->count();
//            });

        $all_apartments_count = DB::table('apartments')
            ->join('properties', 'apartments.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })
            ->select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        $types_rented = Contract::active()
            ->join('contract_apartment', 'contracts.id', '=', 'contract_apartment.contract_id')
            ->join('apartments', 'apartments.id', '=', 'contract_apartment.apartment_id')
            ->join('properties', 'apartments.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })
            ->select('apartments.type', DB::raw('count(*) as count'))
            ->groupBy('apartments.type') // Group apartments by type
            ->get();


        // data processing //
        foreach ($all_apartments_count as $type => $type_count) {
            if ($type_count->type == Apartment::TYPE_HOUSE) {
                $apartment_count = $type_count->count;

            } elseif ($type_count->type == Apartment::TYPE_STORE) {
                $store_count = $type_count->count;
            }
        }

        foreach ($types_rented as $type => $type_rented) {
            if ($type_rented->type == Apartment::TYPE_HOUSE) {
                $apartment_rented_count = $type_rented->count;

            } elseif ($type_rented->type == Apartment::TYPE_STORE) {
                $store_rented_count = $type_rented->count;
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
            $apartment_rented_percent = round(($apartment_rented_count / ($apartment_available_count + $apartment_rented_count)) * 100);
        }

        if ($apartment_available_count + $apartment_rented_count > 0) {
            $apartment_available_percent = round(($apartment_available_count / ($apartment_available_count + $apartment_rented_count)) * 100);
        }

        if ($store_available_count + $store_rented_count > 0) {
            $store_rented_percent = round(($store_rented_count / ($store_available_count + $store_rented_count)) * 100);
        }

        if ($store_available_count + $store_rented_count) {
            $store_available_percent = round(($store_available_count / ($store_available_count + $store_rented_count)) * 100);
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

    public static function getRentalsOverview($type)
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
            ->join('properties', 'apartments.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })
            ->whereNull('contracts.deleted_at')
            ->select('apartments.type', \DB::raw('SUM(contract_apartment.cost) as total_cost'))
            ->groupBy('apartments.type')
            ->get();

        $reports_available = Apartment::available()
            ->join('properties', 'apartments.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })
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
            $rents_percent = round(($rents_amount / ($rents_amount + $available_amount)) * 100);
        }

        if ($rents_amount + $available_amount > 0) {
            $available_percent = round(($available_amount / ($rents_amount + $available_amount)) * 100);
        }

        if ($apartment_rents_amount + $apartment_available_amount > 0) {
            $apartment_rents_percent = round(($apartment_rents_amount / ($apartment_rents_amount + $apartment_available_amount)) * 100);
        }

        if ($apartment_rents_amount + $apartment_available_amount > 0) {
            $apartment_available_percent = round(($apartment_available_amount / ($apartment_rents_amount + $apartment_available_amount)) * 100);
        }

        if ($store_rents_amount + $store_available_amount > 0) {
            $store_rents_percent = round(($store_rents_amount / ($store_rents_amount + $store_available_amount)) * 100);
        }

        if ($store_rents_amount + $store_available_amount > 0) {
            $store_available_percent = round(($store_available_amount / ($store_rents_amount + $store_available_amount)) * 100);
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

    public static function getCollectionOverview($type)
    {
//        $invoices_amount = Invoice::sum('amount');
        $invoices_amount = DB::table('invoices')
            ->select('invoices.amount as invoice_amount', 'invoices.contract_id as contract_id')
            ->join('contract_apartment', 'invoices.contract_id', '=', 'contract_apartment.contract_id')
            ->join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
            ->join('properties', 'apartments.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })->sum('invoices.amount');

//        $collected_amount = Receipt::sum('amount');
        $collected_amount = DB::table('receipts')
            ->select('receipts.amount as receipts_amount', 'receipts.invoice_id as invoice_id')
            ->join('invoices', 'receipts.invoice_id', '=', 'invoices.id')
            ->join('contract_apartment', 'invoices.contract_id', '=', 'contract_apartment.contract_id')
            ->join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
            ->join('properties', 'apartments.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })->sum('receipts.amount');

//        $discount_amount = Discount::sum('amount');
        $discount_amount = DB::table('discounts')
            ->select('discounts.amount as discounts_amount', 'discounts.invoice_id as invoice_id')
            ->join('invoices', 'discounts.invoice_id', '=', 'invoices.id')
            ->join('contract_apartment', 'invoices.contract_id', '=', 'contract_apartment.contract_id')
            ->join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
            ->join('properties', 'apartments.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })->sum('discounts.amount');

        $coming_amount = $invoices_amount - ($collected_amount + $discount_amount);

        return [
            'invoices_amount' => $invoices_amount,
            'collected_amount' => $collected_amount,
            'discount_amount' => $discount_amount,
            'coming_amount' => $coming_amount,
        ];
    }

    public static function getMaintenanceOverview($type)
    {
        $tickets_total = 0;
        $tickets_finished_count = 0;
        $tickets_finished_percent = 0;
        $tickets_open_count = 0;
        $tickets_open_percent = 0;

        $tickets = DB::table('tickets')
            ->selectRaw('tickets.status')
            ->join('properties', 'tickets.property_id', '=', 'properties.id')
            ->when($type, function ($query) use ($type) {
                $query->where('properties.category_id', '=', $type);
            })
            ->get();


        $tickets_finished_count = $tickets->where('status', 3)->count();
        $tickets_open_count = $tickets->where('status', 1)->count();
        $tickets_under_process_count = $tickets->where('status', 2)->count();
        $tickets_total = $tickets_finished_count + $tickets_open_count + $tickets_under_process_count;

        if ($tickets_total > 0) {
            $tickets_finished_percent = round(($tickets_finished_count / $tickets_total) * 100);
            $tickets_open_percent = round(($tickets_open_count / $tickets_total) * 100);
            $tickets_under_process_percent = round(($tickets_under_process_count / $tickets_total) * 100);
        }

        return [
            'tickets_total' => $tickets_total,
            'tickets_finished_count' => $tickets_finished_count,
            'tickets_finished_percent' => $tickets_finished_percent,
            'tickets_open_count' => $tickets_open_count,
            'tickets_open_percent' => $tickets_open_percent,
            'tickets_under_process_count' => $tickets_under_process_count,
            'tickets_under_process_percent' => $tickets_open_percent,
        ];

    }

}
