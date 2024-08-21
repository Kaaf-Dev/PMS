<?php

namespace App\Listeners;

use App\Events\CompanyFinishTicket;
use App\Models\Admin;
use App\Notifications\CompanyFinishTicketNotification;
use App\Notifications\TicketReplyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenCompanyFinishTicket
{

    public function __construct()
    {
        //
    }

    public function handle(CompanyFinishTicket $event)
    {
        $ticket = $event->ticket;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_tickets');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new CompanyFinishTicketNotification($ticket));
        }
    }
}
