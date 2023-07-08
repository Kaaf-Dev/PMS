<?php


Route::prefix('company')->group(function () {

    Route::get('/auth/logout', function () {
        Auth::guard('maintenance_company')->logout();
        return redirect(route('maintenance.auth.login'));

    })->name('maintenance.auth.logout');


    Route::namespace('App\Http\Livewire')->group(function () {
        Route::group([
            'prefix' => 'auth',
            'middleware' => 'guest:maintenance_company',
        ], function () {

            Route::get('/login', Maintenance\Auth\Login::class)->name('maintenance.auth.login');

        });

        Route::group([
            'prefix' => '',
            'middleware' => [
                'auth:maintenance_company',
            ],
        ], function () {
            Route::get('/', Maintenance\Dashboard\Index::class)->name('maintenance.dashboard');
//            Route::get('/profile', Admin\Dashboard\Index::class)->name('admin.account-settings');
        });

        Route::group([
            'prefix' => 'tickets',
            'middleware' => [
                'auth:maintenance_company',
            ],
        ], function () {
            Route::get('/', Maintenance\Ticket\Index::class)->name('maintenance.tickets');
//            Route::get('/{ticket_id}/details', User\Ticket\Details::class)->name('user.tickets.details');
        });

    });
});
