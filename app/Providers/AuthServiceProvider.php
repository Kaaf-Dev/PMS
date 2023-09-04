<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Contract' => 'App\Policies\ContractPolicy',
         'App\Models\Ticket' => 'App\Policies\TicketPolicy',
         'App\Models\ContractApartment' => 'App\Policies\ContractApartmentPolicy',
         'App\Models\MaintenanceInvoice' => 'App\Policies\MaintenanceInvoicePolicy',
         'App\Models\LawyerCase' => 'App\Policies\LawyerCasePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
