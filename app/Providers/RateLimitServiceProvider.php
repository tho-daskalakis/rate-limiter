<?php

namespace App\Providers;

use App\Services\RateLimitService;
use Illuminate\Support\ServiceProvider;

class RateLimitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RateLimitService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Force resolution of the TimerService to initialize it at app start
        $this->app->make(RateLimitService::class);
    }
}
