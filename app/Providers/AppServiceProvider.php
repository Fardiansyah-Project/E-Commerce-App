<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
        // Paginator::useTailwind();
        if (Request::is('admin*')) {
            Paginator::useBootstrap();
        } else {
            // Default untuk user
            Paginator::useTailwind();
        }
    }
}
