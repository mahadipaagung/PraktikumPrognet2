<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View as ViewView;
use App\AdminNotification;
use App\UserNotification;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        view()->composer('layouts.navbar',function(ViewView $view){
            $notif= UserNotification::where('read_at',null)->orderBy('created_at','desc')->limit(5)->get();
            $view->with('notif',$notif);
        });

        view()->composer('admin',function(ViewView $view){
            $notif= AdminNotification::where('read_at',null)->orderBy('created_at','desc')->limit(5)->get();
            $view->with('notif',$notif);
        });

        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        // Schema::defaultStringLength(191);
    }
}
