<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        // if (env('APP_INSTALLED')) {
        //     $this->app->register(\Laravel\Jetstream\JetstreamServiceProvider::class);
        //     $this->app->register(\Inertia\ServiceProvider::class); // For Inertia
        //     $this->app->register(\Laravel\Fortify\FortifyServiceProvider::class); // For Fortify
        // }
        Translatable::fallback(
            fallbackAny: true,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
