<?php

namespace App\Listeners;

use App\Events\LawyerCase;
use App\Events\LawyerChangeCaseDetails;
use App\Models\Admin;
use App\Notifications\LawyerChangeCaseDetailsNotification;
use App\Notifications\LawyerCreateInvoiceNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenLawyerChangeCaseDetails
{

    public function __construct()
    {
        //
    }

    public function handle(LawyerChangeCaseDetails $event)
    {
        $case = $event->case;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_contracts');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new LawyerChangeCaseDetailsNotification($case));
        }
    }
}
