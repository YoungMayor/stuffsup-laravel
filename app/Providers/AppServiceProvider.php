<?php

namespace App\Providers;

use App\Observers\ReviewObserver;
use App\Review;
use App\Tools\SalesImage\Local as SalesImageLocal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('SalesImageLocal', function(){
            return new SalesImageLocal;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Review::observe(ReviewObserver::class);
    }
}
