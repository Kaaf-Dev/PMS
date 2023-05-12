<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalFunctionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once base_path().'/app/Helper/LocaleBladeHelper.php';
        require_once base_path().'/app/Helper/AdminModals.php';
        require_once base_path().'/app/Helper/UserModals.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
