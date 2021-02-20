<?php

namespace GovindTomar\Permission;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'permission');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->mergeConfigFrom(__DIR__.'/config/permission.php', 'permission');

        $this->publishes([
            __DIR__.'/config/permission.php' => config_path('permission.php')
        ], 'config');
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ],'migrations');
        $this->publishes([
            __DIR__.'/Http/Middleware' => app_path('Http/Middleware')
        ],'Middleware');
        $this->publishes([
            __DIR__.'/views/layouts' => resource_path('views/layouts')
        ],'views');
    }
}


// "autoload-dev": {
//     "psr-4": {
//         "Tests\\": "tests/",
//         "GovindTomar\\Permission\\": "package/govindtomar/permission/src/"
//     }
// },

// php artisan vendor:publish --provider="GovindTomar\Permission\PermissionServiceProvider"
