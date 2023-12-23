<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();


        $generalSetting = GeneralSetting::first();

        /** set time zone */
        Config::set('app.timezone', $generalSetting->time_zone);

        /** Share variable at all view */
        View::composer('*', function($view) use ($generalSetting){
            $view->with(['settings' => $generalSetting]);
        });
    }
}
