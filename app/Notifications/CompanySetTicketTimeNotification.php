<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanySetTicketTimeNotification extends Notification
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
            'title' => 'تم تحديد موعد الزيارة',
            'desc' => 'قامت شركة الصيانة بتحديد موعد الزيارة. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-time fs-2 text-warning'
        ];
    }
}
