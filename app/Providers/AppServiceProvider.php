<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if($this->app->environment('production')) {
        //     URL::forceScheme('https');
        // }
        if (env('APP_FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        require_once app_path().'/Helpers/Helper1.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
