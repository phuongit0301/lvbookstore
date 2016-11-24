<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth, View;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {
            if (Auth::check()) {
                $categories = Auth::user()->find(Auth::user()->id)->category()->get();
                $view->with('categories', $categories);
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Interfaces\CategoryInterface', 'App\Repositories\CategoryRepository');
    }
}
