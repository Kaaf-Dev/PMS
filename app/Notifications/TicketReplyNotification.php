<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketReplyNotification extends Notification
{
    use Queueable;

    public $ticket_reply;

    public function __construct($ticket_reply)
    {
        $this->ticket_reply = $ticket_reply;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->ticket_reply->ticket->id,
            'route' => route('admin.tickets.details', ['notification_id' => $this->id, 'ticket_id' => $this->ticket_reply->ticket->id]),
            'title' => 'تعليق جديد على طلب الصيانة',
            'desc' => 'تم إضافة تعليق جديد على طلب الصيانة. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-directbox-default fs-2 text-primary'
        ];
    }

}
