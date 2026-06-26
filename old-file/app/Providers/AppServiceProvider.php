<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator; // Import Validator class

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('recaptcha', 'App\Rules\Recaptcha@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

 
}
