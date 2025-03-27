<?php

namespace SonLeu\IDConnect\Providers;

use SonLeu\IDConnect\Auth\Guards\IDConnectGuard;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class IDConnectServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/id_connect.php' => config_path('id_connect.php'),
        ], 'id_connect_config');

        Auth::extend('id', function (Container $app) {
            return new IDConnectGuard($app['request']);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/id_connect.php', 'id_connect');

        $this->mergeConfigFrom(__DIR__ . '/../Config/guard.php', 'auth.guards');
    }
}
