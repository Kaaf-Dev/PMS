<?php

Route::prefix('admin')->group(function () {

    Route::namespace('App\Http\Livewire')->group(function () {

        Route::get('/dashboard', Admin\Dashboard\Index::class);

    });
});
