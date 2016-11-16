<?php

namespace RML\Providers;

use Illuminate\Support\ServiceProvider;
use RML\Organisasi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function($view)
        {
            $nama_org = Organisasi::get();
            $view->with('nama_org', $nama_org);
        });
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
