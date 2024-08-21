<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreateTicketNotification extends Notification
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
            'route' => route('admin.tickets.details', $this->ticket->id),
            'title' => 'قام المستأجر بإضافة طلب صيانة',
            'desc' => 'أضاف المستأجر طلب صيانة جديد. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-wrench fs-2 text-danger'
        ];
    }
}
