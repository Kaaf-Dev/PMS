<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLastInvoicePaid
{

    public function handle(Request $request, Closure $next)
    {
        $invoice = auth()->user()->invoices()->find($request->invoice_id);

        if (!$invoice) {
            abort(404, 'Invoice not found.');
        }

        $unpaidInvoicesBefore = $invoice->Contract->invoices()
            ->unPaid()
            ->where('due', '<', $invoice->due)
            ->orderBy('due', 'asc')
            ->get();

        if ($unpaidInvoicesBefore->isNotEmpty()) {
            return response()->view('last-invoice-error', [], 404);
        }

        return $next($request);
    }

}
