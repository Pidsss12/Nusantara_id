<?php

namespace App\Providers;

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
        try {
            // Share provinces grouped by island for the Mega Menu
            $provincesByIsland = \Illuminate\Support\Facades\DB::table('provinces')
                ->select('id', 'name', 'island')
                ->get()
                ->groupBy('island');
            
            \Illuminate\Support\Facades\View::share('navbarProvinces', $provincesByIsland);
        } catch (\Exception $e) {
            // Setup phase, ignore if table doesn't exist
        }

        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}
