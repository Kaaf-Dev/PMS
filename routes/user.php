<?php


Route::prefix('my')->group(function () {

    Route::get('/auth/logout', function () {
        Auth::logout();
        return redirect(route('user.auth.login'));

    })->name('user.auth.logout');


    Route::namespace('App\Http\Livewire')->group(function () {
        Route::group([
            'prefix' => 'auth',
            'middleware' => 'guest',
        ], function () {

            Route::get('/login', User\Auth\Login::class)->name('user.auth.login');

        });

        Route::group([
            'prefix' => '',
            'middleware' => [
                'auth',
            ],
        ], function () {
            Route::get('/', User\Dashboard\Index::class)->name('user.dashboard');
//            Route::get('/profile', Admin\Dashboard\Index::class)->name('admin.account-settings');
        });

        Route::group([
            'prefix' => 'contracts',
            'middleware' => [
                'auth',
            ],
        ], function () {
            Route::get('/', User\Contract\Index::class)->name('user.contracts');
            Route::get('/{contract_id}/details', User\Contract\Details::class)->name('user.contracts.details');
        });

    });
});
