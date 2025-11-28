<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    $this->publishes([
        base_path('vendor/generoi/sage-woocommerce/publishes/resources/views')
            => resource_path('views/woocommerce'),
    ], 'woocommerce-template-views');
    }
}
