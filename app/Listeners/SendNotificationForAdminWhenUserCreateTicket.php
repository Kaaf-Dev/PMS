<?php

namespace App\Listeners;

use App\Events\Ticket;
use App\Events\UserCreateTicket;
use App\Models\Admin;
use App\Notifications\LawyerReplyNotification;
use App\Notifications\UserCreateTicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenUserCreateTicket
{

    public function __construct()
    {
        //
    }

    public function handle(UserCreateTicket $event)
    {
        $ticket = $event->ticket;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_tickets');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new UserCreateTicketNotification($ticket));
        }
    }
}
