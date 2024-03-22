<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(Env::get('LOCALE'));
        Schema::defaultStringLength(125);
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
