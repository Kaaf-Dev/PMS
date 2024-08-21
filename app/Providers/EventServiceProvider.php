<?php

namespace App\Providers;

use App\Events\CompanyFinishTicket;
use App\Events\CompanySetTicketTime;
use App\Events\LawyerChangeCaseDetails;
use App\Events\LawyerCreateInvoice;
use App\Events\LawyerReply;
use App\Events\ReceiptCreated;
use App\Events\TicketReply;
use App\Events\UserCreateTicket;
use App\Listeners\SendNotificationForAdminWhenCompanyFinishTicket;
use App\Listeners\SendNotificationForAdminWhenCompanySetTicketTime;
use App\Listeners\SendNotificationForAdminWhenLawyerChangeCaseDetails;
use App\Listeners\SendNotificationForAdminWhenLawyerCreateInvoice;
use App\Listeners\SendNotificationForAdminWhenLawyerReply;
use App\Listeners\SendNotificationForAdminWhenReceiptCreated;
use App\Listeners\SendNotificationForAdminWhenTicketReply;
use App\Listeners\SendNotificationForAdminWhenUserCreateTicket;
use App\Notifications\TicketReplyNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LawyerReply::class => [
            SendNotificationForAdminWhenLawyerReply::class,
        ],
        LawyerCreateInvoice::class => [
            SendNotificationForAdminWhenLawyerCreateInvoice::class,
        ],
        LawyerChangeCaseDetails::class => [
            SendNotificationForAdminWhenLawyerChangeCaseDetails::class,
        ],
        UserCreateTicket::class => [
            SendNotificationForAdminWhenUserCreateTicket::class,
        ],
        CompanySetTicketTime::class => [
            SendNotificationForAdminWhenCompanySetTicketTime::class,
        ],
        TicketReply::class => [
            SendNotificationForAdminWhenTicketReply::class,
        ],
        CompanyFinishTicket::class => [
            SendNotificationForAdminWhenCompanyFinishTicket::class,
        ],
        ReceiptCreated::class => [
            SendNotificationForAdminWhenReceiptCreated::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
