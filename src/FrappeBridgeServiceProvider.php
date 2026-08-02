<?php

namespace Angeom\FrappeBridge;

use Illuminate\Support\ServiceProvider;

class FrappeBridgeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/frappe.php', 'frappe');

        $this->app->singleton('frappe', function ($app) {
            return new FrappeBridge();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/frappe.php' => config_path('frappe.php'),
        ], 'frappe-config');
    }
}
