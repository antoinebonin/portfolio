<?php

namespace App\Providers;

use App\Content\BlocService;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\View;
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
        view()->addNamespace('bloc', app_path('Content/Blocs'));
        BlocService::bootComponent();
        View::share('navbar', MenuRepository::getNavbar());
    }
}
