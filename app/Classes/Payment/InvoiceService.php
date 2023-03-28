<?php

namespace App\Classes\Payment;

use App\Models\Contract;
use App\Models\Invoice;

class InvoiceService
{
    public function generateInvoice($data = [])
    {
        $invoice = new Invoice($data);
        return $invoice->save();
    }
}
