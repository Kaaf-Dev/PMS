<?php

namespace App\Listeners;

use App\Events\TicketReply;
use App\Models\Admin;
use App\Notifications\TicketReplyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenTicketReply
{

    public function __construct()
    {
        //
    }


    public function handle(TicketReply $event)
    {
        $ticket_reply = $event->ticket_reply;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_tickets');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new TicketReplyNotification($ticket_reply));
        }
    }
}
