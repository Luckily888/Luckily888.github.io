<?php

namespace App\Providers;

use App\Model\Currency;
use App\Model\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view)
        {
            if (isset(Auth::user()->id)){
                $notifications = Notification::where(['uid' => Auth::user()->id])->orderBy('created_at','desc')->limit(5)->get();
                $notification_num = Notification::where(['uid' => Auth::user()->id,'readed' => false])->count();
                $currencies = Currency::all();
                View::share(['notifications' => $notifications,'currencies' => $currencies,'notification_num' => $notification_num]);
            }
            if (isset(Auth::user()->id)){
                $notifications = Notification::where(['uid' => Auth::user()->id])->orderBy('created_at','desc')->limit(5)->get();
                $notification_num = Notification::where(['uid' => Auth::user()->id,'readed' => false])->count();
                $currencies = Currency::all();
                View::share(['notifications' => $notifications,'currencies' => $currencies,'notification_num' => $notification_num]);
            }
        });
    }
}
