<?php

namespace App\Listeners;

use App\Events\Receipt;
use App\Events\ReceiptCreated;
use App\Models\Admin;
use App\Notifications\LawyerReplyNotification;
use App\Notifications\ReceiptCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenReceiptCreated
{

    public function __construct()
    {
        //
    }

    public function handle(ReceiptCreated $event)
    {
        $receipt = $event->receipt;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_invoices');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new ReceiptCreatedNotification($receipt));
        }
    }
}
