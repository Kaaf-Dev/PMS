<?php


Route::prefix('admin')->group(function () {

    Route::get('/auth/logout', function () {
        Auth::guard('admin')->logout();
        return redirect(route('admin.auth.login'));

    })->name('admin.auth.logout');


    Route::namespace('App\Http\Livewire')->group(function () {
        Route::group([
            'prefix' => 'auth',
            'middleware' => 'guest:admin',
        ], function () {

            Route::get('/login', Admin\Auth\Login::class)->name('admin.auth.login');

        });

        Route::group([
            'prefix' => '',
            'middleware' => [
                'auth:admin',
            ],
        ], function () {
            Route::get('/', Admin\Dashboard\Index::class)->name('admin.dashboard');
            Route::get('/profile', Admin\Dashboard\Index::class)->name('admin.account-settings');
        });


        Route::group([
            'prefix' => 'users',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\User'
            ],
        ], function () {
            Route::get('/', Admin\Users\Index::class)->name('admin.users');
            Route::get('/{user_id}/details', Admin\Users\Details::class)->name('admin.users.details');
        });


        Route::group([
            'prefix' => 'property',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Property'

            ],
        ], function () {
            Route::get('/', Admin\Property\Index::class)->name('admin.property');
            Route::get('/{property_id}/details', Admin\Property\Details::class)->name('admin.property.details');
        });

        Route::group([
            'prefix' => 'apartment',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Apartment'

            ],
        ], function () {
            Route::get('/', Admin\Property\Apartment\Index::class)->name('admin.apartment');
            Route::get('/{property_id}/apartment/{apartment_id}/details', Admin\Property\Apartment\Details::class)->name('admin.property.apartment.details');
        });


        Route::group([
            'prefix' => 'contracts',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Contract'

            ],
        ], function () {
            Route::get('/', Admin\Contract\Index::class)->name('admin.contracts');
            Route::get('/{contract_id}/details/{notification_id?}', Admin\Contract\Details::class)->name('admin.contracts.details');
        });

        Route::group([
            'prefix' => 'invoices',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Invoice'

            ],
        ], function () {
            Route::get('/', Admin\Invoice\Index::class)->name('admin.invoices');
        });

        Route::group([
            'prefix' => 'tickets',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Ticket'

            ],
        ], function () {
            Route::get('/', Admin\Ticket\Index::class)->name('admin.tickets');
            Route::get('/{ticket_id}/details/{notification_id?}', Admin\Ticket\Details::class)->name('admin.tickets.details');
        });

        Route::group([
            'prefix' => 'maintenance-companies',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Ticket'

            ],
        ], function () {
            Route::get('/', Admin\MaintenanceCompany\Index::class)->name('admin.maintenance-companies');
        });

        Route::group([
            'prefix' => 'ticket-categories',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Ticket'

            ],
        ], function () {
            Route::get('/', Admin\TicketCategory\Index::class)->name('admin.ticket-categories');
        });

        Route::group([
            'prefix' => 'lawyers',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Lawyer'

            ],
        ], function () {
            Route::get('/', Admin\Lawyer\Index::class)->name('admin.lawyers');
        });

        Route::group([
            'prefix' => 'maintenance-invoices',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Ticket'

            ],
        ], function () {
            Route::get('/', Admin\MaintenanceInvoice\Index::class)->name('admin.maintenance-invoices');
        });

        Route::group([
            'prefix' => 'reports',
            'middleware' => [
                'auth:admin',
                'can:manage_reports'
            ],
        ], function () {
            Route::get('/', Admin\Report\Index::class)->name('admin.reports');
        });

        Route::group([
            'prefix' => 'staff',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Admin'

            ],
        ], function () {
            Route::get('/', Admin\Staff\Index::class)->name('admin.staff');
        });

        Route::group([
            'prefix' => 'roles',
            'middleware' => [
                'auth:admin',
                'can:viewAny,\App\Models\Role'

            ],
        ], function () {
            Route::get('/', Admin\Role\Index::class)->name('admin.role');
            Route::get('/details/{role_id}', Admin\Role\Details::class)->name('admin.details');
        });



    });
});
