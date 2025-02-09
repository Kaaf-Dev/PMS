<?php

namespace App\Listeners;

use App\Events\InvoiceCreated;
use App\Jobs\InvoiceConfirmationEmail;
use App\Models\Contract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInvoiceMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InvoiceCreated  $event
     * @return void
     */
    public function handle(InvoiceCreated $event)
    {
        $invoice = $event->invoice;
        InvoiceConfirmationEmail::dispatch($invoice);

    }
}
