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
            ],
        ], function () {
            Route::get('/', Admin\Users\Index::class)->name('admin.users');
            Route::get('/{user_id}/details', Admin\Users\Details::class)->name('admin.users.details');
        });



        Route::group([
            'prefix' => 'property',
            'middleware' => [
                'auth:admin',
            ],
        ], function () {
            Route::get('/', Admin\Property\Index::class)->name('admin.property');
            Route::get('/{property_id}/details', Admin\Property\Index::class)->name('admin.property.details');
        });





    });
});
