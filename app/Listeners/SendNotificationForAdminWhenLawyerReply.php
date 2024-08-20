<?php

namespace App\Listeners;

use App\Events\LawyerReply;
use App\Models\Admin;
use App\Notifications\AdminProjectCompletedNotification;
use App\Notifications\LawyerReplyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationForAdminWhenLawyerReply
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
     * @param \App\Events\LawyerReply $event
     * @return void
     */
    public function handle(LawyerReply $event)
    {
        $reply = $event->reply;
        $admins = Admin::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.slug', 'manage_contracts');
        })->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new LawyerReplyNotification($reply));
        }
    }
}
