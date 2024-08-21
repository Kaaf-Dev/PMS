<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LawyerCreateInvoiceNotification extends Notification
{
    use Queueable;

    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {

        return [
            'id' => $this->invoice->LawyerCase->contract_id,
            'route' => route('admin.contracts.details', ['notification_id' => $this->id, 'contract_id' => $this->invoice->LawyerCase->contract_id]),
            'title' => 'قام المحامي بإضافة فاتورة',
            'desc' => 'أضاف المحامي فاتورة جديدة على العقد. يُرجى مراجعة التفاصيل.',
            'icon' => 'ki-outline ki-add-files fs-2 text-success'
        ];
    }
}
