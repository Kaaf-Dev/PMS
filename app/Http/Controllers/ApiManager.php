<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;

class ApiManager extends Controller
{
    public function getAllReceipts()
    {
        return Receipt::whereNotNull('transaction_id')->with([
            'Invoice',
            'Invoice.Contract',
            'Invoice.Contract.User',
            'Invoice.Contract.apartments.Property'
        ])->paginate(10);
    }

}
