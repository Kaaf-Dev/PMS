<?php

namespace App\Providers;

use App\Events\LawyerChangeCaseDetails;
use App\Events\LawyerCreateInvoice;
use App\Events\LawyerReply;
use App\Listeners\SendNotificationForAdminWhenLawyerChangeCaseDetails;
use App\Listeners\SendNotificationForAdminWhenLawyerCreateInvoice;
use App\Listeners\SendNotificationForAdminWhenLawyerReply;
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
