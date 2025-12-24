<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use URL;
use View;
use App\View\Composers\NavbarCuacaComposer;

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
        View::composer('components.layouts.app', NavbarCuacaComposer::class);
    }
}
