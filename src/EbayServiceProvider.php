<?php

namespace Hkonnet\LaravelEbay;

use Illuminate\Support\ServiceProvider;

class EbayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Boot config file
        $this->publishes([
            __DIR__.'/Config/ebay.php' => config_path('ebay.php'),
        ], 'config');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Config
        $this->mergeConfigFrom( __DIR__.'/Config/ebay.php', 'ebay');

        $this->app->singleton('ebay', function () {
            return new Ebay();
        });
    }


}
