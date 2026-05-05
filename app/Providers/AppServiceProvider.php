<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();
        // Share settings and counts with admin layouts
        View::composer('layouts.admin', function ($view) {
            $settings = Setting::all()->pluck('value', 'key');
            $view->with('homeSettings', $settings['homeSettings'] ?? []);
            $view->with('contactSettings', $settings['contactSettings'] ?? []);
            $view->with('seoSettings', $settings['seoSettings'] ?? []);
            
            $view->with('newBookingsCount', Booking::where('status', 'new')->count());
            $view->with('newMessagesCount', Message::where('is_replied', 0)->count());
        });

        // Share settings with frontend too
        View::composer(['welcome', 'sections.*'], function ($view) {
            $settings = Setting::all()->pluck('value', 'key');
            $view->with('homeSettings', $settings['homeSettings'] ?? []);
            $view->with('contactSettings', $settings['contactSettings'] ?? []);
            $view->with('seoSettings', $settings['seoSettings'] ?? []);
        });
    }
}
