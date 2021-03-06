<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (\Laravel\Lumen\Http\Request $request) {
            if ($request->header('Authorization')) {
                $bearerData = explode('Bearer ', $request->header('Authorization'));
                if (count($bearerData) < 2) {
                    return null;
                }

                return User::where('api_token', $bearerData[1])->first();
            }
        });
    }
}
