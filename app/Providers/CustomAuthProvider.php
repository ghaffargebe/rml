<?php namespace RML\Providers;

use Illuminate\Support\Facades\Auth;

use RML\Providers\CustomUserProvider;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('custom', function($app, array $config) {
       // Return an instance of             Illuminate\Contracts\Auth\UserProvider...
        return new CustomUserProvider($app['custom.connection']);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}