<?php

namespace App\Classes\Payment;

use App\Models\Contract;
use App\Models\Invoice;

class InvoiceService
{

    public function newInvoice($data = [])
    {
        return new Invoice($data);
    }

    public function generateInvoice($data = [])
    {
        return $this->generateInvoice()->save();
    }

    public function saveInvoice(Invoice $invoice)
    {
        return $invoice->save();
    }
}
