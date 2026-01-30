<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\ContactMessageComposer;
use App\Repositories\CategoryRepository;
use App\Repositories\MenuRepository;
use App\Services\MenuService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register repositories
        $this->app->singleton(CategoryRepository::class);
        $this->app->singleton(MenuRepository::class);

        // Register services
        $this->app->singleton(MenuService::class, function ($app) {
            return new MenuService($app->make(MenuRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register view composers
        View::composer(['components.navbar', 'pages.menu'], CategoryComposer::class);
        
        // Share jumlah pesan baru ke sidebar admin
        View::composer('admin.components.sidebar', ContactMessageComposer::class);
    }
}
