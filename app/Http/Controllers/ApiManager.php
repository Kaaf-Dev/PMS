<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;

class ApiManager extends Controller
{
    public function getAllReceipts(Request $request)
    {
        $receipt_id = $request->receipt_id;

        return Receipt::query()
            ->when($receipt_id, fn($query) => $query->where('id', $receipt_id))
            ->whereNotNull('transaction_id')
            ->with([
                'Invoice.Contract.User',
                'Invoice.Contract.apartments.Property',
            ])
            ->paginate(10);
    }

}
