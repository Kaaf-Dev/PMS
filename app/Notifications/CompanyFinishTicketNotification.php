<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyFinishTicketNotification extends Notification
{
    use Queueable;

    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->ticket->id,
            'route' => route('admin.tickets.details', ['notification_id' => $this->id, 'ticket_id' => $this->ticket->id]),
            'title' => 'طلب الصيانة تم اعتماده',
            'desc' => 'تمت مراجعة واعتماد طلب الصيانة بنجاح. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-check fs-2 text-success'
        ];
    }
}
