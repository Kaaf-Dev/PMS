<?php


Route::prefix('lawyer')->group(function () {

    Route::get('/auth/logout', function () {
        Auth::guard('lawyer')->logout();
        return redirect(route('lawyer.auth.login'));

    })->name('lawyer.auth.logout');


    Route::namespace('App\Http\Livewire')->group(function () {
        Route::group([
            'prefix' => 'auth',
            'middleware' => 'guest:lawyer',
        ], function () {

            Route::get('/login', Lawyer\Auth\Login::class)->name('lawyer.auth.login');

        });

        Route::group([
            'prefix' => '',
            'middleware' => [
                'auth:lawyer',
            ],
        ], function () {
            Route::get('/', Lawyer\Dashboard\Index::class)->name('lawyer.dashboard');
//            Route::get('/profile', Admin\Dashboard\Index::class)->name('admin.account-settings');
        });

        Route::group([
            'prefix' => 'contracts',
            'middleware' => [
                'auth:lawyer',
            ],
        ], function () {
            Route::get('/', Lawyer\Contract\Index::class)->name('lawyer.contracts');
            Route::get('/{contract_id}/details', Lawyer\Contract\Details::class)->name('lawyer.contracts.details');
        });

    });
});
