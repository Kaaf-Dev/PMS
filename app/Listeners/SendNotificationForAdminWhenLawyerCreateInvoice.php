<?php

namespace App\Listeners;

use App\Events\LawyerCreateInvoice;
use App\Models\Admin;
use App\Notifications\LawyerCreateInvoiceNotification;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenLawyerCreateInvoice
{
    public function __construct()
    {
        //
    }

    public function handle(LawyerCreateInvoice $event)
    {
        $invoice = $event->invoice;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_contracts');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new LawyerCreateInvoiceNotification($invoice));
        }
    }
}
