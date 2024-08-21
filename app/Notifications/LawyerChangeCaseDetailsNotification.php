<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LawyerChangeCaseDetailsNotification extends Notification
{
    use Queueable;

    public $case;

    public function __construct($case)
    {
        $this->case = $case;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {

        return [
            'id' => $this->case->contract_id,
            'route' => route('admin.contracts.details', $this->case->contract_id),
            'title' => 'قام المحامي بتحديث القضية',
            'desc' => 'أضاف المحامي تحديث على بيانات القضية. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-pencil fs-2 text-success'
        ];
    }
}
