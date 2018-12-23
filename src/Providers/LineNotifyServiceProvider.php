<?php

namespace Royalmar\LineNotify\Providers;

use Illuminate\Support\ServiceProvider;

class LineNotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/LineNotify.php' => config_path('LineNotify.php'),
        ], 'line_notify_install');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('LineNotify', function ($app) {
            return $app->make('Royalmar\LineNotify\Services\LineNotifyService');
        });
    }
}
