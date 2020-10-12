<?php

namespace App\Providers;

use App\Models\Category;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        view()->composer('endUser.layouts.side-bar', 'App\Http\Composer\CategoryComposer');

//
//        View::composer('*', function ($view) {
//
//            $view->with('$categories', $this->categories);
//        });
    }
}
