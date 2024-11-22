<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $host = request()->getHost();

        if (str_contains($host, 'host.fitnessity.co')) {
            Config::set('session.domain', 'host.fitnessity.co');
            Config::set('session.cookie', 'sub_session');
        } else {
            Config::set('session.domain', 'dev.fitnessity.co');
            Config::set('session.cookie', 'main_session');
        }
    }
}
