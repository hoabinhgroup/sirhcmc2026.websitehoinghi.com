<?php

namespace App\Providers;

use App\Support\Navigation;
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
        View::composer('components.header', function ($view) {
            $view->with([
                'headerMenu' => Navigation::headerMenu(),
                'navActive' => fn (array $item): bool => Navigation::isActive($item),
            ]);
        });

        View::composer('components.footer', function ($view) {
            $view->with([
                'footerMenu' => Navigation::footerMenu(),
                'footerPartners' => Navigation::footerPartners(),
            ]);
        });
    }
}
