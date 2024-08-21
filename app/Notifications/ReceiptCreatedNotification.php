<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReceiptCreatedNotification extends Notification
{
    use Queueable;

    public $receipt;

    public function __construct($receipt)
    {
        $this->receipt = $receipt;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->receipt->invoice->contract_id,
            'route' => route('admin.contracts.details', ['notification_id' => $this->id, 'contract_id' => $this->receipt->invoice->contract_id]),
            'title' => 'إيجار مُدَفوع من المستأجر',
            'desc' => 'تم استلام دفع الإيجار من قبل المستأجر بنجاح. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-dollar fs-2 text-primary'
        ];
    }
}
