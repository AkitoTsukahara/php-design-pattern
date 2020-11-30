<?php // app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    public function boot()
    {
        //
    }

    public function register()
    {
        app()->bind('classA', ClassA::class);
    }
}