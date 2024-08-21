<?php

namespace App\Listeners;

use App\Events\CompanySetTicketTime;
use App\Events\Ticket;
use App\Models\Admin;
use App\Notifications\CompanySetTicketTimeNotification;
use App\Notifications\UserCreateTicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenCompanySetTicketTime
{

    public function __construct()
    {
        //
    }

    public function handle(CompanySetTicketTime $event)
    {
        $ticket = $event->ticket;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_tickets');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new CompanySetTicketTimeNotification($ticket));
        }
    }
}
