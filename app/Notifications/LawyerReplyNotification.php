<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LawyerReplyNotification extends Notification
{
    use Queueable;

    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->reply->contract_id,
            'route' => route('admin.contracts.details', $this->reply->contract_id),
            'title' => 'قام المحامي بإضافة تعليق',
            'desc' => 'أضاف المحامي تعليقًا جديدًا على العقد. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-briefcase fs-2 text-warning'
        ];
    }
}
